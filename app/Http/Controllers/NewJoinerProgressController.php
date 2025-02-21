<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewJoinerProgress;
use App\Models\NewJoiner;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\log;
use App\Models\TrainingSteps;

class NewJoinerProgressController extends Controller
{
    // Fetch progress for a specific joiner
    public function showProgress($newJoinerId)
    {
        $progress = NewJoinerProgress::where('new_joiner_id', $newJoinerId)
            ->whereHas('step') // ✅ Ignore records with missing steps
            ->with('step') // ✅ Load step relationship
            ->get()
            ->sortBy('step.step_order') // ✅ Sort the results based on step_order
    
            ->values(); // ✅ Reset array keys to prevent issues
    
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
