<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Milon\Barcode\DNS1D;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Employee;


class BadgeController extends Controller
{
    // Display the badge maker page
    public function index()
    {
        $employees = \App\Models\Employee::all(); 
        $branches=Branch::all();
        return view('badge.index', compact('employees','branches'));
    }

    public function getEmployeesByBranch($branchId)
    {
        // Check if branchId exists
        if (!$branchId) {
            return response()->json(['error' => 'Branch ID is required'], 400);
        }

        // Fetch employees belonging to the branch
        $employees = Employee::where('branch_id', $branchId)->get();

        // Check if employees exist
        if ($employees->isEmpty()) {
            return response()->json(['error' => 'No employees found for this branch'], 404);
        }

        return response()->json($employees, 200);
    }
}
