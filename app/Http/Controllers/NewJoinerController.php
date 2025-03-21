<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\NewJoiner;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\TrainingSteps;
use App\Events\NewNotification;
use App\Models\NewJoinerProgress;
use App\Models\NewJoinerReference;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\EmployeePhaseProgress;

class NewJoinerController extends Controller
{
    public function index()
    {
        $newJoiners = NewJoiner::with('jobRelation')->orderBy('start_date', 'asc')->take(20)->get();
        $steps = TrainingSteps::orderBy('step_order', 'asc')->get();
        $progressSteps = NewJoinerProgress::all();

        return view('new-joiner.index', compact('newJoiners', 'steps', 'progressSteps'));
    }

    public function create()
    {
        $steps = TrainingSteps::orderBy('step_order', 'asc')->get();
        $jobs = Job::all();
        return view('new-joiner.create', compact('steps', 'jobs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'mode' => 'required|string',
            'start_date' => 'required|date',
            'job' => 'required|string',
            'target_branch' => 'nullable|string',
        ]);

        $newJoiner = NewJoiner::create($validated);

        $firstStep = TrainingSteps::orderBy('step_order')->first();

        if ($firstStep) {
            DB::table('new_joiner_progress')->insert([
                'new_joiner_id' => $newJoiner->id,
                'step_id' => $firstStep->id,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
                'interview_time' => $request->interview_time,
            ]);
            Log::info("✅ First Step Assigned: {$firstStep->id} - {$firstStep->name}");
        } else {
            Log::warning('❌ No Steps Found in TrainingSteps Table!');
        }

        $adminUsers = User::role('Admin')->get();
        foreach ($adminUsers as $admin) {
            // Skip sending notification to the logged-in admin
            if ($admin->id == Auth::id()) {
                continue; // Skip the current admin
            }

            $notification = Notification::create([
                'user_id' => $admin->id,
                'type' => 'admin_alert',
                'message' => Auth::user()->name . " has added {$newJoiner->name} as a New Joiner Employee.",
                'notified_at' => now(),
                'is_read' => false,
                'user_image' => Auth::user()->image,
            ]);
        }

        broadcast(new NewNotification($notification))->toOthers();

        return redirect()->route('new-joiners.index')->with('success', 'New joiner added and first step initialized!');
    }

    public function edit($id)
    {
        $newJoiner = NewJoiner::findOrFail($id);
        $reference = NewJoinerReference::where('new_joiner_id', $id)->first();
        $jobs = Job::all();

        return view('new-joiner.edit', compact('newJoiner', 'jobs', 'reference'));
    }

    public function update(Request $request, $id)
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'mode' => 'required|string',
            'start_date' => 'required|date',
            'job' => 'required|string',
            'target_branch' => 'nullable|string',
        ]);

        // Find and update the new joiner
        $newJoiner = NewJoiner::findOrFail($id);
        $newJoiner->update($validated);

        // Check if 'Back to Silva' step is completed
        $backToSilvaStep = TrainingSteps::where('name', 'Back to Silva')->first();

        $isStepCompleted = NewJoinerProgress::where('new_joiner_id', $id)->where('step_id', $backToSilvaStep->id)->where('status', 'completed')->exists();

        // Only create/update reference if the step is completed
        if ($isStepCompleted) {
            NewJoinerReference::updateOrCreate(['new_joiner_id' => $id], $request->only(['company_name', 'contact_name', 'phone', 'position', 'have_recommendation_letter', 'feedback']));
        }

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
            $notification = Notification::create([
                'user_id' => $admin->id,
                'type' => 'admin_alert',
                'message' => Auth::user()->name . " has deleted {$newJoiner->name} From the New Joiner List.",
                'notified_at' => now(),
                'is_read' => false,
                'user_image' => Auth::user()->image,
            ]);
        }

        broadcast(new NewNotification($notification))->toOthers();

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
                $query->where('step_id', $stepId)->where('status', 'pending');
            })->get();
        }

        $finalStep = TrainingSteps::orderBy('step_order', 'desc')->first();

        $newJoiners->each(function ($joiner) use ($finalStep) {
            $currentStepProgress = $joiner->progress->where('status', 'pending')->sortBy('step.step_order')->first();

            if (!$currentStepProgress && $finalStep) {
                $joiner->current_step = $finalStep->name;
                $joiner->current_step_id = null; // No step ID if finished
                $joiner->interview_time = null; // ✅ No interview time
            } else {
                $joiner->current_step = $currentStepProgress ? $currentStepProgress->step->name : 'Completed All Steps';
                $joiner->current_step_id = $currentStepProgress ? $currentStepProgress->id : null; // ✅ ID taba3 l progress
                $joiner->interview_time = $currentStepProgress ? $currentStepProgress->interview_time : null; // ✅ Add interview_time
            }
        });

        return response()->json($newJoiners);
    }

    public function countByStep()
    {
        try {
            // ✅ Fetch all steps sorted by step_order
            $allSteps = DB::table('training_steps')
                ->orderBy('step_order')
                ->pluck('id') // Only fetch step IDs
                ->toArray();

            // ✅ Get pending progress for each step
            $progressData = DB::table('new_joiner_progress')->where('status', 'pending')->orderBy('step_id')->get()->groupBy('new_joiner_id');

            // ✅ Initialize counts dynamically with step_id as key
            $stepCounts = array_fill_keys($allSteps, 0);

            foreach ($progressData as $joinerProgress) {
                foreach ($joinerProgress as $progress) {
                    if (isset($stepCounts[$progress->step_id])) {
                        $stepCounts[$progress->step_id]++;
                    }
                    break;
                }
            }

            return response()->json($stepCounts);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function EditStepTime($id)
    {
        $step = NewJoinerProgress::find($id);

        if (!$step) {
            return redirect()->back()->with('error', 'Record not found!');
        }

        return view('new-joiner.edit_step_time', compact('step'));
    }

    public function UpdateStepTime(Request $request)
    {
        $validateData = $request->validate([
            'interview_time' => 'nullable|string',
            'id' => 'required',
        ]);

        $step = NewJoinerProgress::find($request->id);
        if (!$step) {
            return redirect()->back()->with('error', 'Record not found!');
        }
        $step->update($validateData);

        return redirect()->route('new-joiners.index')->with('success', 'Time Updated Successfully!');
    }

    public function storeReference(Request $request)
    {
        Log::info('Received Reference Form Data:', $request->all());

        // ✅ Validate input
        $validated = $request->validate([
            'new_joiner_id' => 'required|exists:new_joiner,id',
            'company_name' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'position' => 'required|string|max:100',
            'feedback' => 'nullable|string|max:500',
            'have_recommendation_letter' => 'boolean',
        ]);

        // ✅ Insert reference data
        DB::table('new_joiner_references')->insert([
            'new_joiner_id' => $validated['new_joiner_id'],
            'company_name' => $validated['company_name'],
            'contact_name' => $validated['contact_name'],
            'phone' => $validated['phone'],
            'position' => $validated['position'],
            'feedback' => $validated['feedback'],
            'have_recommendation_letter' => $validated['have_recommendation_letter'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ✅ Fetch the new joiner
        $newJoiner = NewJoiner::findOrFail($validated['new_joiner_id']);

        // ✅ Fetch the current step
        $currentProgress = NewJoinerProgress::where('new_joiner_id', $newJoiner->id)->where('status', 'pending')->first();

        if ($currentProgress) {
            // ✅ Mark current step as completed
            $currentProgress->update([
                'status' => 'completed',
                'completed_at' => now(),
            ]);

            Log::info("Step '{$currentProgress->step->name}' completed for {$newJoiner->name}.");
        }

        // ✅ Get the next step
        $nextStep = TrainingSteps::where('step_order', '>', $currentProgress->step->step_order)->orderBy('step_order', 'asc')->first();

        if ($nextStep) {
            // ✅ Assign the next step to the new joiner
            NewJoinerProgress::create([
                'new_joiner_id' => $newJoiner->id,
                'step_id' => $nextStep->id,
                'status' => 'pending',
            ]);

            Log::info("Next step '{$nextStep->name}' assigned to {$newJoiner->name}.");
        } else {
            // ✅ No more steps, mark the new joiner as completed
            $newJoiner->update(['status' => 'completed']);
            Log::info("New joiner '{$newJoiner->name}' has completed all steps.");
        }

        // ✅ Notify admins about progress update
        $adminUsers = User::role('Admin')->get();
        foreach ($adminUsers as $admin) {
            if ($admin->id == Auth::id()) {
                continue;
            }

            Log::info("Creating admin notification for {$admin->name}");
            $notification = Notification::create([
                'user_id' => $admin->id,
                'type' => 'admin_alert',
                'message' => Auth::user()->name . " marked step '{$currentProgress->step->name}' as completed for {$newJoiner->name}.",
                'notified_at' => now(),
                'is_read' => false,
                'user_image' => Auth::user()->image,
            ]);

            broadcast(new NewNotification($notification))->toOthers();
        }

        return response()->json(['success' => 'Reference saved & next step assigned successfully!']);
    }
}
