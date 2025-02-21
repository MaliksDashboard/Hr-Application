<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainingSteps;

class TrainingStepsController extends Controller
{
    public function index()
    {
        $steps = TrainingSteps::orderBy('step_order', 'asc')->get();
        return view('new-joiner.steps', compact('steps'));
    }

    public function create()
    {
        return view('new-joiner.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'required|string|max:7', // Validate color format (#RRGGBB)
        ]);

        $maxOrder = TrainingSteps::max('step_order') ?? 0;
        $validated['step_order'] = $maxOrder + 1;

        $step = TrainingSteps::create($validated);

        return response()->json([
            'success' => 'Step added successfully!',
            'step' => [
                'id' => $step->id,
                'name' => $step->name,
                'step_order' => $step->step_order,
                'color' => $step->color,
            ],
        ]);
    }

    public function edit(TrainingSteps $step)
    {
        return view('new-joiner.edit', compact('step'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'required|string|max:7',
        ]);

        $step = TrainingSteps::findOrFail($id);
        $step->update($request->all());

        return response()->json(['success' => 'Step updated successfully!']);
    }

    public function destroy($id)
    {
        try {
            $step = TrainingSteps::findOrFail($id);
            $step->delete();

            return response()->json(['success' => 'The step has been deleted.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete the step.'], 500);
        }
    }

    public function updateRanks(Request $request)
    {
        $steps = $request->steps;

        foreach ($steps as $rank => $id) {
            TrainingSteps::where('id', $id)->update(['step_order' => $rank]);
        }

        return response()->json(['success' => 'Steps order updated successfully!']);
    }

    public function show($id)
    {
        $step = TrainingSteps::findOrFail($id);
    
        return response()->json([
            'step' => $step,
        ]);
    }

    public function getStepData()
    {
        $steps = TrainingSteps::all();
        return response()->json($steps);
    }
}
