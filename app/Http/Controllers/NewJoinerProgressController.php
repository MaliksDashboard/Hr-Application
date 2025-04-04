<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\NewJoiner;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\TrainingSteps;
use App\Events\NewNotification;
use App\Models\NewJoinerProgress;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class NewJoinerProgressController extends Controller
{
    // Fetch progress for a specific joiner
    public function showProgress($newJoinerId)
    {
        $progress = NewJoinerProgress::where('new_joiner_id', $newJoinerId)
            ->whereHas('step')
            ->with(['step:id,name,step_order'])
            ->select('id', 'step_id', 'status', 'completed_at', 'remarks', 'new_joiner_id') // 👈 ADD THIS
            ->get()
            ->sortBy('step.step_order')
            ->values();


        return response()->json($progress);
    }

    // Mark a step as completed
    public function completeStep(Request $request)
    {
        // ✅ Debug incoming request
        Log::info('Request Data:', $request->all());

        try {
            $request->validate([
                'new_joiner_id' => 'required|exists:new_joiner,id',
                'step_id' => 'required|exists:training_steps,id',
                'completion_date' => 'required|date',
                'remarks' => 'nullable|string|max:500',
            ]);

            $selectedStep = TrainingSteps::findOrFail($request->step_id);

            // ✅ Debug previous steps check
            Log::info('Checking previous steps');

            // ✅ Corrected previous steps check (EXCLUDE the current step)
            $previousStepsPending = NewJoinerProgress::where('new_joiner_id', $request->new_joiner_id)
                ->whereHas('step', function ($query) use ($selectedStep) {
                    $query->where('step_order', '<', $selectedStep->step_order);
                })
                ->where('status', 'pending')
                ->exists();

            if ($previousStepsPending) {
                return response()->json(['error' => 'You must complete previous steps first.'], 403);
            }

            // ✅ Debug progress check
            Log::info('Checking if progress record exists');

            $progress = NewJoinerProgress::where('new_joiner_id', $request->new_joiner_id)->where('step_id', $request->step_id)->first();

            if (!$progress) {
                Log::info('Creating new progress entry');
                $progress = NewJoinerProgress::create([
                    'new_joiner_id' => $request->new_joiner_id,
                    'step_id' => $request->step_id,
                    'status' => 'completed',
                    'completed_at' => $request->completion_date,
                    'remarks' => $request->remarks,
                ]);
            } else {
                Log::info('Updating existing progress entry');
                $progress->update([
                    'status' => 'completed',
                    'completed_at' => $request->completion_date,
                    'remarks' => $request->remarks,
                ]);
            }

            // ✅ Fetch the NewJoiner instance to use in the notification
            $newJoiner = NewJoiner::findOrFail($request->new_joiner_id);

            // ✅ Get the next step
            $nextStep = TrainingSteps::where('step_order', '>', $selectedStep->step_order)->orderBy('step_order', 'asc')->first();

            if ($nextStep) {
                // ✅ Create a new record for the next step
                NewJoinerProgress::create([
                    'new_joiner_id' => $request->new_joiner_id,
                    'step_id' => $nextStep->id,
                    'status' => 'pending',
                ]);

                Log::info("Next step '{$nextStep->name}' assigned to new joiner.");
            } else {
                // ✅ No more steps, mark the new joiner as completed
                $newJoiner->update(['status' => 'completed']);
                Log::info("New joiner '{$newJoiner->name}' has completed all steps.");
            }

            $adminUsers = User::role('Admin')->get();
            foreach ($adminUsers as $admin) {
                // Skip sending notification to the logged-in admin
                if ($admin->id == Auth::id()) {
                    continue;
                }

                Log::info("Creating admin notification for {$admin->name}");
                $notification = Notification::create([
                    'user_id' => $admin->id,
                    'type' => 'admin_alert',
                    'message' => Auth::user()->name . " has marked step '{$selectedStep->name}' as completed for {$newJoiner->name}.",
                    'notified_at' => now(),
                    'is_read' => false,
                    'user_image' => Auth::user()->image,
                ]);
            }

            broadcast(new NewNotification($notification))->toOthers();

            return response()->json(['success' => 'Step marked as completed!']);
        } catch (\Exception $e) {
            Log::error('Error in completeStep:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Server error: ' . $e->getMessage()], 500);
        }
    }

    // Assign all steps to a new joiner when they are created
    public function initializeProgress($newJoinerId)
    {
        $steps = TrainingSteps::orderBy('step_order', 'asc')->get();

        foreach ($steps as $step) {
            NewJoinerProgress::firstOrCreate(
                [
                    'new_joiner_id' => $newJoinerId,
                    'step_id' => $step->id,
                ],
                [
                    'status' => 'pending',
                ],
            );
        }

        return response()->json(['success' => 'Progress initialized for the new joiner!']);
    }
}
