<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\Job;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::with('department')->orderBy('id', 'desc')->get();
        return view('jobs.index', compact('jobs'));
    }
    

    public function create()
    {
        $departments = Department::orderBy('id', 'desc')->get();
        return view('jobs.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'dept_id' => 'nullable|exists:departments,id',
        ]);

        Job::create([
            'name' => $validateData['name'],
            'dept_id' => $validateData['dept_id'] ?? null,
        ]);

        return redirect()->route('jobs.index')->with('success', 'Job Added Successfully!');
    }

    public function edit($id)
    {
        $departments = Department::all();
        $job = Job::find($id);

        return view('jobs.edit', compact('departments', 'job'));
    }

    public function update(Request $request, Job $job)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'dept_id' => 'required|exists:departments,id',
        ]);

        $job->update([
            'name'=> $validateData['name'],
            'dept_id'=> $validateData['dept_id'] ?? null,
        ]);

        return redirect()->route('jobs.index')->with('success','Job Updated Successfully!');
    }

    public function destroy($id)
    {
        $job = Job::find($id);

        if (!$job) {
            return redirect()->route('jobs.index')->with('error', 'Job not found.');
        }

        $job->delete();
        return redirect()->route('jobs.index')->with('success', 'Job Deleted Successfully');
    }
}
