<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Models\Vacancy;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class VacancyController extends Controller
{
    public function index()
    {
        $vacancies = Vacancy::with('branch')
            ->where('is_finished', 0)
            ->orWhereNull('is_finished')
            ->orderBy('created_at', 'desc') // Sort by latest created_at
            ->get();

        $vacanciesCompleted = Vacancy::with('branch')
            ->where('is_finished', 1)
            ->orderBy('updated_at', 'desc') // Sort by latest updated_at
            ->limit(20) // Limit to 10 records
            ->get();

        return view('vacancy.index', compact('vacancies', 'vacanciesCompleted'));
    }

    public function create()
    {
        $branches = Branch::orderBy('branch_name', 'asc')->get();
        $jobs = DB::table('employee_info')->pluck('job');
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
            ]);

            // Create the vacancy
            $vacancy = Vacancy::create($validated);

            // Get the user who created the vacancy
            $creator = Auth::user(); // The user who created the vacancy

            // Get the branch name
            $branchName = $vacancy->branch->branch_name ?? 'N/A'; // Using optional chaining to handle null values

            // Notify all admins about the new vacancy except the creator
            $adminUsers = User::where('role_name', 'Admin')->get();
            foreach ($adminUsers as $admin) {
                // Skip the creator of the vacancy
                if ($admin->id !== $creator->id) {
                    Notification::create([
                        'user_id' => $admin->id,
                        'type' => 'admin_alert',
                        'message' => "{$creator->name} has created a new vacancy for the job '{$vacancy->job}' at {$branchName}.",
                        'notified_at' => now(),
                        'is_read' => false,
                        'user_image' => $creator->image ?? '/images/Default.jpg',
                    ]);
                }
            }

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
        $jobs = DB::table('employee_info')->pluck('job');

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
            $adminUsers = User::where('role_name', 'Admin')->get();
            foreach ($adminUsers as $admin) {
                if ($admin->id !== $creator->id) {
                    // Skip the creator
                    Notification::create([
                        'user_id' => $admin->id,
                        'type' => 'admin_alert',
                        'message' => "{$creator->name} has deleted the vacancy for the job '{$job}' at {$branchName}.",
                        'notified_at' => now(),
                        'is_read' => false,
                        'user_image' => $creator->image ?? '/images/Default.jpg',
                    ]);
                }
            }

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
            return response()->json(['vacancies' => []], 200); // Return empty if no branch selected
        }

        $vacancies = Vacancy::where('branch_id', $branchId)->where('is_finished', false)->orderBy('created_at', 'desc')->get();

        return response()->json(['vacancies' => $vacancies], 200);
    }
}
