<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Department;
use App\Models\Employee;

class DepartmentController extends Controller
{
    public function index()
    {
        $department = Department::all();
        return view('departments.index', compact('department'));
    }

    public function create()
    {
        $employees = Employee::whereHas('jobRelation', function ($query) {
            $query->where('name', 'Team Leader'); // Ensure 'name' is the correct column
        })->get();
        return view('departments.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'head_of_dept_id' => 'required|exists:employee_info,id',
        ]);

        log::info('Validated Data:', $validateData);

        Department::create([
            'name' => $validateData['name'],
            'head_of_dept_id' => $validateData['head_of_dept_id'],
        ]);

        return redirect()->route('departments.index')->with('success', 'Department Added Successfully!');
    }

    public function edit($id)
    {
        $employees = Employee::where('job', '=', 'Team Leader')->get();
        $department = Department::find($id);
        return view('departments.edit', compact('department', 'employees'));
    }

    public function update(Request $request, Department $department)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'head_of_dept_id' => 'required|exists:employee_info,id',
        ]);

        $department->update([
            'name' => $validateData['name'],
            'head_of_dept_id' => $validateData['head_of_dept_id'],
        ]);

        return redirect()->route('departments.index')->with('success', 'Department Updated Successfully');
    }

    public function destroy($id)
    {
        $department = Department::find($id);

        if (!$department) {
            return redirect()->route('departments.index')->with('error', 'Department not found.');
        }

        $department->delete();
        return redirect()->route('departments.index')->with('success', 'Department Deleted Successfully');
    }

    public function getDeptData()
    {
        try {
            $departments = Department::with('headOfDept')->orderBy('name', 'asc')->get();

            return response()->json(
                $departments->map(function ($department) {
                    return [
                        'id' => $department->id,
                        'name' => $department->name,
                        'manager_name' => $department->headOfDept ? $department->headOfDept->name : 'Not Assigned',
                        'manager_image' => $department->headOfDept ? $department->headOfDept->image_path : 'N/A',
                    ];
                }),
            );
        } catch (\Exception $e) {
            Log::error('Error fetching departments: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch departments'], 500);
        }
    }
}
