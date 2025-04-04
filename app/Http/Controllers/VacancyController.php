<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use App\Models\Branch;
use App\Models\Vacancy;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Events\NewNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class VacancyController extends Controller
{
    public function index(Request $request)
    {
        $area = $request->input('area'); // From ?area=Shar2iye or Gharbiye
    
        // To Do vacancies
        $vacancies = Vacancy::with(['branch', 'jobRelation'])
            ->where(function ($query) {
                $query->where('is_finished', 0)->orWhereNull('is_finished');
            })
            ->when($area, function ($query, $area) {
                $query->where('area', $area);
            })
            ->orderBy('created_at', 'desc')
            ->get();
    
        // Completed vacancies
        $vacanciesCompleted = Vacancy::with(['branch', 'jobRelation'])
            ->where('is_finished', 1)
            ->when($area, function ($query, $area) {
                $query->where('area', $area);
            })
            ->orderBy('updated_at', 'desc')
            ->limit(20)
            ->get();
    
        $jobs = Job::all();
    
        return view('vacancy.index', compact('vacancies', 'vacanciesCompleted', 'jobs'));
    }
    

    public function create()
    {
        $branches = Branch::orderBy('branch_name', 'asc')->get();
        $jobs = Job::all();
        return view('vacancy.create', compact('branches', 'jobs'));
    }

    public function store(Request $request)
    {
        try {
            // Validate input data
            $validated = $request->validate([
                'branch_id' => 'required|exists:branches,id',
                'job' => 'required|string|max:255',
                'status' => 'required|in:low,medium,high',
                'asked_date' => 'required|date',
                'remarks' => 'nullable|string|max:1000',
                'shift' => 'nullable|string|max:255',
                'area'=>'nullable|string|max:255',
            ]);

            // Create the vacancy
            $vacancy = Vacancy::create($validated);

            // Get the user who created the vacancy
            $creator = Auth::user(); // The user who created the vacancy

            // Get the branch name
            $branchName = $vacancy->branch->branch_name ?? 'N/A'; // Using optional chaining to handle null values

            // Notify all admins about the new vacancy except the creator
            $adminUsers = User::role('Admin')->get(); // ✅ Fetch admins using Spatie roles
            foreach ($adminUsers as $admin) {
                // Skip the creator of the vacancy
                if ($admin->id !== $creator->id) {
                    $notification = Notification::create([
                        'user_id' => $admin->id,
                        'type' => 'admin_alert',
                        'message' => "{$creator->name} has created a new vacancy for the job '{$vacancy->job}' at {$branchName}.",
                        'notified_at' => now(),
                        'is_read' => false,
                        'user_image' => $creator->image ?? '/images/Default.jpg',
                    ]);
                }
            }

            broadcast(new NewNotification($notification))->toOthers();

            // Return success response
            return redirect()->route('vacancies.index')->with('success', 'Vacancy created successfully!');
        } catch (\Exception $e) {
            return redirect()
                ->route('vacancies.index')
                ->with('error', 'Failed to create vacancy: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $vacancy = Vacancy::findOrFail($id);
        $branches = Branch::orderBy('branch_name', 'asc')->get();
        $employees = DB::table('employee_info')
            ->join('branches', 'employee_info.branch_id', '=', 'branches.id') // Join branches table
            ->select('employee_info.id', 'employee_info.name', 'employee_info.image_path', 'employee_info.pin_code', 'branches.branch_name') // Select desired columns
            ->where('employee_info.status', 1) // Include only employees with status = 1
            ->get();
        $jobs = Job::all();

        return view('vacancy.edit', compact('vacancy', 'branches', 'employees', 'jobs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|exists:branches,id',
            'job' => 'required|string|max:255',
            'asked_date' => 'required|date',
            'status' => 'required|in:low,medium,high',
            'is_finished' => 'required|boolean',
            'employee_id' => 'nullable|exists:employee_info,id',
            'remarks' => 'nullable|string|max:1000',
            'shift' => 'nullable|string|max:255',
            'area'=>'nullable|string|max:255',
        ]);

        $vacancy = Vacancy::findOrFail($id);

        $vacancy->update([
            'branch_id' => $request->name,
            'job' => $request->job,
            'asked_date' => $request->asked_date,
            'completed_date' => $request->is_finished ? now() : null,
            'status' => $request->status,
            'is_finished' => $request->is_finished,
            'employee_id' => $request->employee_id,
            'image_path' => $request->employee_id ? DB::table('employee_info')->where('id', $request->employee_id)->value('image_path') : null,
            'remarks' => $request->remarks,
            'shift' => $request->shift,
            'area'=>$request->area,
        ]);

        return redirect()->route('vacancies.index')->with('success', 'Vacancy updated successfully!');
    }

    public function destroy($id)
    {
        try {
            // Find the vacancy by ID
            $vacancy = Vacancy::findOrFail($id);

            // Get the authenticated user (the one performing the action)
            $creator = Auth::user();

            // Get the job and branch details for the notification
            $job = $vacancy->job;
            $branchName = $vacancy->branch->branch_name ?? 'N/A';

            // Notify all admins about the deletion except the user who performed the action
            $adminUsers = User::role('Admin')->get(); // ✅ Fetch admins using Spatie roles
            foreach ($adminUsers as $admin) {
                if ($admin->id !== $creator->id) {
                    // Skip the creator
                    $notification = Notification::create([
                        'user_id' => $admin->id,
                        'type' => 'admin_alert',
                        'message' => "{$creator->name} has deleted the vacancy for the job '{$job}' at {$branchName}.",
                        'notified_at' => now(),
                        'is_read' => false,
                        'user_image' => $creator->image ?? '/images/Default.jpg',
                    ]);
                }
            }

            broadcast(new NewNotification($notification))->toOthers();

            // Delete the vacancy
            $vacancy->delete();

            // Return success response
            return redirect()->route('vacancies.index')->with('success', 'Vacancy deleted successfully!');
        } catch (\Exception $e) {
            // Handle the exception and return error message
            Log::error('Error deleting vacancy: ' . $e->getMessage());
            return redirect()->route('vacancies.index')->with('error', 'Failed to delete vacancy.');
        }
    }

    public function fetch(Request $request)
    {
        $branchId = $request->query('branch_id');

        if (!$branchId) {
            return response()->json(['vacancies' => []], 200);
        }

        // ✅ Ensure jobRelation is loaded
        $vacancies = Vacancy::with('jobRelation')->where('branch_id', $branchId)->where('is_finished', false)->orderBy('created_at', 'desc')->get();

        // ✅ Map data correctly
        $vacancies = $vacancies->map(function ($vacancy) {
            return [
                'id' => $vacancy->id,
                'branch_id' => $vacancy->branch_id,
                'job_id' => $vacancy->job_id, // Keep this for reference
                'job_name' => optional($vacancy->jobRelation)->name, // ✅ FIXED
                'asked_date' => $vacancy->created_at->format('Y-m-d'),
                'status' => $vacancy->status,
                'is_finished' => $vacancy->is_finished,
                'employee_id' => $vacancy->employee_id,
                'image_path' => $vacancy->image_path,
                'remarks' => $vacancy->remarks,
                'created_at' => $vacancy->created_at,
                'updated_at' => $vacancy->updated_at,
            ];
        });

        return response()->json(['vacancies' => $vacancies], 200);
    }

    public function getBranchesWithVacancies()
    {
        $branches = Branch::select('id', 'branch_name', 'latitude', 'longitude')
            ->withCount([
                'vacancies' => function ($query) {
                    $query->where('is_finished', 0); // Only count unfinished vacancies
                },
            ])
            ->get();

        return response()->json($branches); // ✅ Send JSON response
    }
}
