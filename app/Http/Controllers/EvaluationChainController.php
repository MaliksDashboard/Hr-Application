<?php

namespace App\Http\Controllers;

use App\Models\EvaluationChain;
use App\Models\Department;
use App\Models\Job;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class EvaluationChainController extends Controller
{
    public function index()
    {
        $chains = EvaluationChain::with(['job', 'department'])->get();
        return view('evaluation_chains.index', compact('chains'));
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name'); // ['Branch Manager' => 'Branch Manager']
        $departments = Department::pluck('name', 'id');
        $jobs = Job::pluck('name', 'id'); // Adjust if your job name field is different
        return view('evaluation_chains.create', compact('roles', 'departments', 'jobs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'evaluator_role' => 'required|string',
            'target_role' => 'required|string',
            'priority' => 'required|integer|min:1',
            'skip_if_done_by_higher' => 'required|boolean',
            'department_id' => 'nullable|exists:departments,id',
            'job_id' => 'nullable|exists:jobs_work,id',
        ]);

        EvaluationChain::create($request->all());

        return redirect()->route('evaluation-chains.index')->with('success', 'Rule added successfully.');
    }

    public function edit(EvaluationChain $evaluationChain)
    {
        $roles = Role::pluck('name', 'name');
        $departments = Department::pluck('name', 'id');
        $jobs = Job::pluck('name', 'id');
        return view('evaluation_chains.edit', compact('evaluationChain', 'roles', 'departments', 'jobs'));
    }

    public function update(Request $request, EvaluationChain $evaluationChain)
    {
        $request->validate([
            'evaluator_role' => 'required|string',
            'target_role' => 'required|string',
            'priority' => 'required|integer|min:1',
            'skip_if_done_by_higher' => 'required|boolean',
            'department_id' => 'nullable|exists:departments,id',
            'job_id' => 'nullable|exists:jobs_work,id',
        ]);

        $evaluationChain->update($request->all());

        return redirect()->route('evaluation-chains.index')->with('success', 'Rule updated successfully.');
    }

    public function destroy(EvaluationChain $evaluationChain)
    {
        $evaluationChain->delete();
        return redirect()->route('evaluation-chains.index')->with('success', 'Rule deleted.');
    }

    public function getData()
    {
        $chains = EvaluationChain::with(['job', 'department'])->get();
    
        $mapped = $chains->map(function ($chain) {
            return [
                'id' => $chain->id,
                'evaluator_role' => $chain->evaluator_role,
                'target_role' => $chain->target_role,
                'job_name' => $chain->job?->name,
                'department_name' => $chain->department?->name,
                'priority' => $chain->priority,
                'skip_if_done_by_higher' => $chain->skip_if_done_by_higher,
            ];
        });
    
        return response()->json($mapped);
    }
}
