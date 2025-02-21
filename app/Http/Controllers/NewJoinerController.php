<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Employee;
use App\Models\NewJoiner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\EmployeePhaseProgress;
use App\Models\TrainingSteps;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class NewJoinerController extends Controller
{
    public function index()
    {
        $newJoiners = NewJoiner::orderBy('start_date', 'asc')->take(20)->get();
        $steps = TrainingSteps::orderBy('step_order', 'asc')->get();

        return view('new-joiner.index', compact('newJoiners', 'steps'));
    }

    public function create()
    {
        $steps = TrainingSteps::orderBy('step_order', 'asc')->get();
        $jobs = DB::table('employee_info')->distinct()->pluck('job');
        return view('new-joiner.create', compact('steps', 'jobs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'mode' => 'required|string',
            'start_date' => 'required|date',
            'job' => 'required|string',
        ]);

        // Create the new joiner record
        $newJoiner = NewJoiner::create($validated);

        $adminUsers = User::role('Admin')->get();
        foreach ($adminUsers as $admin) {
            // Skip sending notification to the logged-in admin
            if ($admin->id == Auth::id()) {
                continue; // Skip the current admin
            }

            Log::info("Creating admin notification for {$admin->name}");
            Notification::create([
                'user_id' => $admin->id,
                'type' => 'admin_alert',
                'message' =>  Auth::user()->name . " has added {$newJoiner->name} as a New Joiner Employee.",
                'notified_at' => now(),
                'is_read' => false,
                'user_image' => Auth::user()->image,
            ]);
        }

        // Initialize progress for the new joiner (Assign all steps)
        app(NewJoinerProgressController::class)->initializeProgress($newJoiner->id);

        return redirect()->route('new-joiners.index')->with('success', 'New joiner added and progress initialized!');
    }

    public function edit($id)
    {
        $newJoiner = NewJoiner::findOrFail($id);
        $jobs = DB::table('employee_info')->distinct()->pluck('job'); // Fetch available job positions

        return view('new-joiner.edit', compact('newJoiner', 'jobs'));
    }

    public function update(Request $request, $id)
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'mode' => 'required|string',
            'start_date' => 'required|date',
            'job' => 'required|string',
        ]);

        // Find and update the new joiner
        $newJoiner = NewJoiner::findOrFail($id);
        $newJoiner->update($validated);

        return redirect()->route('new-joiners.index')->with('success', 'New joiner details updated successfully!');
    }

    public function destroy($id)
    {
        $newJoiner = NewJoiner::findOrFail($id);

        // Delete progress records related to this joiner
        $newJoiner->progress()->delete();


        $adminUsers = User::role('Admin')->get();
        foreach ($adminUsers as $admin) {
            // Skip sending notification to the logged-in admin
            if ($admin->id == Auth::id()) {
                continue; // Skip the current admin
            }

            Log::info("Creating admin notification for {$admin->name}");
            Notification::create([
                'user_id' => $admin->id,
                'type' => 'admin_alert',
                'message' =>  Auth::user()->name . " has deleted {$newJoiner->name} From the New Joiner List.",
                'notified_at' => now(),
                'is_read' => false,
                'user_image' => Auth::user()->image,
            ]);
        }

        // Delete the new joiner
        $newJoiner->delete();

        return response()->json(['success' => 'New joiner deleted successfully!']);
    }

    public function filterByStep($stepId)
    {
        if ($stepId == 'all') {
            $newJoiners = NewJoiner::all();
        } else {
            $newJoiners = NewJoiner::whereHas('progress', function ($query) use ($stepId) {
                $query->where('step_id', $stepId)->where('status', 'pending'); // They must be currently in this step
            })
                ->whereDoesntHave('progress', function ($query) use ($stepId) {
                    $query->where('status', 'pending')->whereHas('step', function ($subQuery) use ($stepId) {
                        $subQuery->where('step_order', '<', function ($subSubQuery) use ($stepId) {
                            $subSubQuery->select('step_order')->from('training_steps')->where('id', $stepId);
                        });
                    });
                })
                ->get();
        }

        $finalStep = TrainingSteps::orderBy('step_order', 'desc')->first(); // ✅ Get the last step dynamically

        $newJoiners->each(function ($joiner) use ($finalStep) {
            $currentStep = $joiner->progress->where('status', 'pending')->sortBy('step.step_order')->first();

            if (!$currentStep && $finalStep) {
                $joiner->current_step = $finalStep->name; // ✅ Set to "Ready" dynamically
            } else {
                $joiner->current_step = $currentStep ? $currentStep->step->name : 'Completed All Steps';
            }
        });

        return response()->json($newJoiners);
    }
}
