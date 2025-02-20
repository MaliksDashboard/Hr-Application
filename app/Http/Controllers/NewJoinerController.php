<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\NewJoiner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use  App\Models\EmployeePhaseProgress;

class NewJoinerController extends Controller
{

    public function index()
    {
        $newJoiners = NewJoiner::all();
        return view('new-joiner.index', compact('newJoiners'));
    }

    public function create()
    {
        $branches = Branch::orderBy('branch_name', 'asc')->get();
        $jobs = DB::table('employee_info')->distinct()->pluck('job');

        return view('new-joiner.create', compact('branches', 'jobs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mode' => 'required',
            'date_mode' => 'required|date',
            'job' => 'required',
            'current_branch' => 'nullable',
            'remarks' => 'nullable|string|max:255'
        ]);

        NewJoiner::create([
            'name' => $request->input('name'),
            'mode' => $request->input('mode'),
            'date_mode' => $request->input('date_mode'),
            'job' => $request->input('job'),
            'current_branch' => $request->input('current_branch') ?? null,
            'remarks' => $request->input('remarks') ?? null,
        ]);

        return redirect()->back()->with('success', 'New joiner added successfully!');
    }

    public function getNewJoinersData()
    {
        $newJoiners = NewJoiner::all();
        return response()->json($newJoiners);
    }

    public function getEmployeeProgress($id)
    {
        try {
            // Fetch all records for the selected employee ordered by date
            $records = NewJoiner::where('id', $id)->orderBy('date_mode')->pluck('mode');

            // Debugging: Check API response
            if ($records->isEmpty()) {
                return response()->json(['error' => 'No records found for this employee'], 404);
            }

            // Define the hierarchy of phases
            $phases = [
                "First Interview - Silva",
                "To Start Training",
                "Started Training",
                "Godfather Training",
                "Already Team Member"
            ];

            // Determine the latest progress
            $latestMode = $records->last() ?? "First Interview - Silva"; // Default to phase 1 if no records

            // Debugging: Check phase index
            $completedIndex = array_search($latestMode, $phases);
            if ($completedIndex === false) {
                return response()->json(['error' => 'Invalid mode found in database'], 400);
            }

            return response()->json([
                'phases' => $phases,
                'completed' => $completedIndex,
            ]);
        } catch (\Exception $e) {
            // Capture the error and return a proper JSON response
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function savePhaseProgress(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:new_joiners,id',
            'completed_at' => 'required|date',
            'next_phase_start_at' => 'required|date'
        ]);

        EmployeePhaseProgress::create([
            'employee_id' => $request->employee_id,
            'phase' => "Current Phase Completed", // You can adjust this dynamically
            'completed_at' => $request->completed_at,
            'next_phase_start_at' => $request->next_phase_start_at
        ]);

        return response()->json(['message' => 'Phase updated successfully!']);
    }
}
