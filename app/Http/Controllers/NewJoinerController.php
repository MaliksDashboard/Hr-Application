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
use Carbon\Carbon;

class NewJoinerController extends Controller
{

    public function index()
    {
        return view('new-joiner.index');
    }

    public function create()
    {
        $jobs = Job::all();
        return view('new-joiner.create', compact('jobs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'mode' => 'required|string',
            'start_date' => 'required|date',
            'job' => 'required|string',
            'target_branch' => 'nullable|string',
            'interview_time' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            // 1. Create New Joiner
            $newJoiner = NewJoiner::create($validated);

            // 2. Get First Step in Training
            $firstStep = TrainingSteps::orderBy('step_order')->first();

            if (!$firstStep) {
                DB::rollBack();
                return redirect()->back()->with('error', '❌ No training steps found!');
            }

            // 3. Insert First Step as Pending
            NewJoinerProgress::create([
                'new_joiner_id' => $newJoiner->id,
                'step_id' => $firstStep->id,
                'status' => 'pending',
                'interview_time' => $request->interview_time,
            ]);

            // 4. Notify All Admins Except Self
            $admins = User::role('Admin')->where('id', '!=', Auth::id())->get();
            foreach ($admins as $admin) {
                $notification = Notification::create([
                    'user_id' => $admin->id,
                    'type' => 'admin_alert',
                    'message' => Auth::user()->name . " added {$newJoiner->name} as a New Joiner.",
                    'notified_at' => now(),
                    'is_read' => false,
                    'user_image' => Auth::user()->image ?? null,
                ]);

                broadcast(new NewNotification($notification))->toOthers();
            }

            DB::commit();

            return redirect()->route('new-joiners.index')
                ->with('success', '✅ New joiner created and first step initialized!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while saving the joiner.');
        }
    }

    public function edit($id)
    {
        $newJoiner = NewJoiner::findOrFail($id);
        $jobs = Job::all();

        return view('new-joiner.edit', compact('newJoiner', 'jobs'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'mode' => 'required|string',
            'start_date' => 'required|date',
            'job' => 'required|string',
            'target_branch' => 'nullable|string',
            'interview_time' => 'nullable|string',
            'company_name' => 'nullable|string',
            'contact_name' => 'nullable|string',
            'phone' => 'nullable|string',
            'position' => 'nullable|string',
            'have_recommendation_letter' => 'nullable|boolean',
            'feedback' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            // Update New Joiner Info
            $newJoiner = NewJoiner::findOrFail($id);
            $newJoiner->update($validated);

            // Update Interview Time in current progress (if exists)
            $progress = NewJoinerProgress::where('new_joiner_id', $newJoiner->id)
                ->orderBy('id') // first step
                ->first();

            if ($progress) {
                $progress->update([
                    'interview_time' => $request->interview_time,
                ]);
            }

            // Update or create reference record
            $newJoiner->reference()->updateOrCreate(
                ['new_joiner_id' => $newJoiner->id],
                [
                    'company_name' => $request->company_name,
                    'contact_name' => $request->contact_name,
                    'phone' => $request->phone,
                    'position' => $request->position,
                    'have_recommendation_letter' => $request->have_recommendation_letter,
                    'feedback' => $request->feedback,
                ]
            );

            DB::commit();

            return redirect()->route('new-joiners.index')->with('success', '✅ New joiner updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', '❌ Failed to update joiner.');
        }
    }

    public function destroy($id)
    {
        $joiner = NewJoiner::find($id);

        if (!$joiner) {
            return response()->json(['error' => 'Joiner not found.'], 404);
        }

        $joiner->delete();

        return response()->json(['success' => 'Joiner deleted successfully.']);
    }

    public function getStepsWithCount()
    {
        $steps = TrainingSteps::orderBy('step_order')->get();

        // Get pending count per step (used for step filters)
        $stepCounts = NewJoinerProgress::where('status', 'pending')
            ->selectRaw('step_id, COUNT(*) as count')
            ->groupBy('step_id')
            ->pluck('count', 'step_id');

        // Total joiners (even completed ones)

        $totalJoiners = NewJoiner::count();
        log::info($totalJoiners);

        $response = $steps->map(function ($step) use ($stepCounts) {
            return [
                'id' => $step->id,
                'name' => $step->name,
                'count' => $stepCounts[$step->id] ?? 0,
                'color' => $step->color,
            ];
        });

        // Add "All" button first
        $response->prepend([
            'id' => 'all',
            'name' => 'All',
            'count' => $totalJoiners,
            'color' => '#00B7F1',
        ]);

        return response()->json($response);
    }

    public function fetchJoiners()
    {
        $joiners = NewJoiner::with(['progress.step'])
            ->get()
            ->map(function ($joiner) {
                $currentProgress = $joiner->progress->where('status', 'pending')->sortBy('step.step_order')->first();
                $finalStep = TrainingSteps::orderBy('step_order', 'desc')->first();

                return [
                    'id' => $joiner->id,
                    'name' => $joiner->name,
                    'job' => $joiner->job ?? 'Unknown',
                    'target_branch' => $joiner->target_branch,
                    'start_date' => $joiner->start_date,
                    'step_name' => $currentProgress?->step->name ?? 'Completed',
                    'status' => $currentProgress?->status ?? 'completed',
                    'step_color' => $currentProgress?->step->color ?? '#ccc',
                    'is_first_step' => $joiner->progress->first()?->id === $currentProgress?->id,
                ];
            });

        return response()->json($joiners);
    }

    public function filterByStep($stepId)
    {
        if ($stepId === 'all') {
            $joiners = NewJoiner::with(['progress.step'])
                ->get()
                ->map(function ($joiner) {
                    $latest = $joiner->progress->sortByDesc('step.step_order')->first();

                    return [
                        'id' => $joiner->id,
                        'name' => $joiner->name,
                        'job' => $joiner->job ?? 'N/A',
                        'target_branch' => $joiner->target_branch,
                        'start_date' => $joiner->start_date,
                        'current_step' => optional($latest->step)->name ?? 'N/A',
                        'current_step_status' => $latest->status ?? 'pending',
                        'current_step_id' => $latest->step_id ?? null,
                        'is_rollbackable' => optional($latest->step)->is_rollbackable == 1,
                        'is_reference_step' => optional($latest->step)->is_reference_step ?? false,
                        'is_reference_exists' => NewJoinerReference::where('new_joiner_id', $joiner->id)->exists(),
                    ];
                });
        } else {
            $joiners = NewJoiner::whereHas('progress', function ($q) use ($stepId) {
                $q->where('step_id', $stepId)
                    ->where('status', 'pending'); // ✅ Only get pending for that step
            })
                ->with(['progress.step'])->get()
                ->map(function ($joiner) use ($stepId) {
                    $progress = $joiner->progress->where('step_id', $stepId)->first();

                    if ($progress->status === 'completed' && optional($progress->step)->is_rollbackable != 1) {
                        return null; // 🔥 Skip completed steps that are NOT rollbackable
                    }

                    return [
                        'id' => $joiner->id,
                        'name' => $joiner->name,
                        'job' => optional($joiner->jobRelation)->name ?? 'N/A',
                        'target_branch' => $joiner->target_branch,
                        'start_date' => $joiner->start_date,
                        'current_step' => optional($progress->step)->name ?? 'N/A',
                        'current_step_status' => $progress->status ?? 'pending',
                        'current_step_id' => $progress->step_id ?? null,
                        'is_rollbackable' => optional($progress->step)->is_rollbackable == 1,
                        'is_reference_step' => optional($progress->step)->is_reference_step ?? 0,
                        'is_reference_exists' => NewJoinerReference::where('new_joiner_id', $joiner->id)->exists(),
                    ];
                })->filter(); // ❗ remove nulls
        }

        return response()->json($joiners);
    }
    public function markStepComplete(Request $request, $id)
    {
        $request->validate([
            'completion_date' => 'required|date',
            'remarks' => 'nullable|string',
        ]);

        $progress = NewJoinerProgress::where('new_joiner_id', $id)
            ->where('status', 'pending')
            ->first();

        if (!$progress) {
            return response()->json(['success' => false, 'message' => 'No pending step found.']);
        }

        // ✅ Mark current as completed
        $progress->update([
            'status' => 'completed',
            'completion_date' => $request->completion_date,
            'remarks' => $request->remarks,
        ]);

        // ✅ Find next step based on step_order
        $currentStep = TrainingSteps::find($progress->step_id);
        $nextStep = TrainingSteps::where('step_order', '>', $currentStep->step_order)
            ->orderBy('step_order')
            ->first();

        if ($nextStep) {
            // ✅ Add next step as pending
            NewJoinerProgress::create([
                'new_joiner_id' => $id,
                'step_id' => $nextStep->id,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function rollbackStep(Request $request, $id)
    {
        $stepId = $request->step_id;

        $progress = NewJoinerProgress::where('new_joiner_id', $id)
            ->where('step_id', $stepId)
            ->where('status', 'pending')
            ->first();

        if (!$progress) {
            return response()->json(['error' => 'Step is not pending or no progress found.'], 404);
        }

        // Store the deleted progress info
        $deletedStepOrder = optional($progress->step)->step_order;

        // Delete the progress
        $progress->delete();

        // Find and revert previous progress
        $previous = NewJoinerProgress::where('new_joiner_id', $id)
            ->where('created_at', '<', $progress->created_at)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($previous) {
            $previous->update([
                'status' => 'pending',
                'completed_at' => null,
                'remarks' => null,
            ]);

            // If rollback went to before or on reference step -> delete reference
            $previousStepOrder = optional($previous->step)->step_order;

            if ($previousStepOrder <= $deletedStepOrder) {
                NewJoinerReference::where('new_joiner_id', $id)->delete();
            }
        }

        return response()->json(['success' => 'Rolled back to previous step.']);
    }


    public function getHistory($id)
    {
        $joiner = NewJoiner::with('jobRelation')->findOrFail($id);
        $progress = NewJoinerProgress::where('new_joiner_id', $id)
            ->with('step')
            ->orderBy('created_at', 'asc')
            ->get();

        $history = $progress->map(function ($p) use ($joiner) {
            return [
                'step' => $p->step->name ?? 'Unknown',
                'status' => $p->status,
                'completed_at' => $p->completed_at,
                'remarks' => $p->remarks,
                'name' => $joiner->name,
                'job' => $joiner->job ?? 'No Job',
                'target_branch' => $joiner->target_branch ?? '-',
                'start_date' => $joiner->start_date,
            ];
        });

        return response()->json($history);
    }

    public function getReferenceData($id)
    {
        $joiner = NewJoiner::with('reference')->findOrFail($id);

        return response()->json([
            'company_name' => $joiner->reference->company_name ?? '',
            'contact_name' => $joiner->reference->contact_name ?? '',
            'phone' => $joiner->reference->phone ?? '',
            'position' => $joiner->reference->position ?? '',
            'feedback' => $joiner->reference->feedback ?? '',
            'have_recommendation_letter' => $joiner->reference->have_recommendation_letter ?? false,
            'has_sejel' => $joiner->has_sejel ?? false,
        ]);
    }
    public function markReferenceComplete(Request $request, $id)
    {
        $request->validate([
            'completion_date' => 'required|date',
            'remarks' => 'nullable|string|max:500',
            'company_name' => 'nullable|string|max:255',
            'contact_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'position' => 'nullable|string|max:255',
            'feedback' => 'nullable|string',
            'have_recommendation_letter' => 'boolean',
            'has_sejel' => 'boolean',
        ]);

        $joiner = NewJoiner::findOrFail($id);
        $progress = $joiner->progress()->latest('created_at')->first();

        if (!$progress || $progress->status === 'completed') {
            return response()->json(['error' => 'Invalid or already completed step'], 400);
        }

        // ✅ Use Carbon
        $progress->update([
            'status' => 'completed',
            'completed_at' => Carbon::parse($request->completion_date),
            'remarks' => $request->remarks,
        ]);

        NewJoinerReference::updateOrCreate(
            ['new_joiner_id' => $joiner->id],
            [
                'company_name' => $request->company_name,
                'contact_name' => $request->contact_name,
                'phone' => $request->phone,
                'position' => $request->position,
                'feedback' => $request->feedback,
                'have_recommendation_letter' => $request->have_recommendation_letter,
            ]
        );

        $joiner->update([
            'has_sejel' => $request->has_sejel ? 1 : 0,
        ]);

        // ✅ Now auto-create the next step
        $currentStep = TrainingSteps::find($progress->step_id);
        $nextStep = TrainingSteps::where('step_order', '>', $currentStep->step_order)
            ->orderBy('step_order')
            ->first();

        if ($nextStep) {
            NewJoinerProgress::create([
                'new_joiner_id' => $id,
                'step_id' => $nextStep->id,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return response()->json(['success' => 'Reference step completed and next step created.']);
    }
}
