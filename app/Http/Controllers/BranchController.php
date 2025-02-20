<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\log;


class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::all();
        return view('branches.index', compact('branches'));
    }

    public function create()
    {
        return view('branches.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'branch_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'manager_email' => 'nullable|email|unique:branches,manager_email',
            'services_gmail' => 'nullable|email|unique:branches,services_gmail',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        Branch::create([
            'branch_name' => $validatedData['branch_name'],
            'location' => $validatedData['location'],
            'manager_email' => $validatedData['manager_email'],
            'services_gmail' => $validatedData['services_gmail'],
            'latitude' => $validatedData['latitude'],
            'longitude' => $validatedData['longitude'],
        ]);

        return redirect()->route('branches.index')->with('success', 'Branch added successfully!');
    }

    public function edit($id)
    {
        $branch = Branch::findOrFail($id);
        return view('branches.edit', compact('branch'));
    }

    public function update(Request $request, Branch $branch)
    {
        $validatedData = $request->validate([
            'branch_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'manager_email' => 'nullable|email|unique:branches,manager_email,' . $branch->id,
            'services_gmail' => 'nullable|email|unique:branches,services_gmail,' . $branch->id,
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $branch->update([
            'branch_name' => $validatedData['branch_name'],
            'location' => $validatedData['location'],
            'manager_email' => $validatedData['manager_email'],
            'services_gmail' => $validatedData['services_gmail'],
            'latitude' => $validatedData['latitude'],
            'longitude' => $validatedData['longitude'],
        ]);

        return redirect()->route('branches.index')->with('success', 'Branch updated successfully!');
    }

    public function destroy($id)
    {
        try {
            $branch = Branch::findOrFail($id);
            $branch->delete();

            return redirect()->route('branches.index')->with('success', 'Branch Deleted successfully!');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('branches.index')->with('error', 'Branch not found!');
        } catch (\Exception $e) {
            return redirect()->route('branches.index')->with('error', 'An error occurred while deleting the branch!');
        }
    }

    public function getBranchesData()
    {
        $branches = Branch::select('id', 'branch_name', 'location', 'manager_email')->get(); // Include 'id'
        return response()->json($branches);
    }

    public function getBranchesManager()
    {
        // Fetch titles and their ranks from the database
        $titles = DB::table('titles')
            ->select('name', 'rank')
            ->orderBy('rank', 'asc') // Ensure ascending order by rank
            ->pluck('name', 'rank'); // Pluck names with ranks as keys

        // Get the branches with employees filtered by title dynamically
        $branches = Branch::with([
            'employees' => function ($query) use ($titles) {
                $query->whereIn('title', $titles->values()->toArray()) // Use dynamic titles
                    ->orderByRaw("FIELD(title," . implode(',', $titles->values()->map(fn($t) => "'$t'")->toArray()) . ")");
            }
        ])->get();

        // Map branches with their respective top-ranked managers
        $branchesWithManagers = $branches->map(function ($branch) {
            $manager = $branch->employees->first();
            return [
                'id' => $branch->id,
                'branch_name' => $branch->branch_name,
                'location' => $branch->location,
                'manager_name' => $manager ? $manager->name : 'Not Found',
                'manager_image' => $manager && $manager->image_path
                    ? asset('storage/' . ltrim($manager->image_path, '/')) // Ensure no leading slash
                    : asset('storage/images/Default.jpg'), // Default image
            ];
        });

        return response()->json($branchesWithManagers);
    }

    public function fetchBranchEmployees(Branch $branch)
    {
        try {
            // Fetch titles dynamically from the database
            $titles = DB::table('titles')
                ->select('name', 'rank', 'category')
                ->orderBy('rank', 'asc') // Order by rank for proper hierarchy
                ->get();
    
            // Separate titles by category
            $managerTitles = $titles->where('category', 'manager')->pluck('name');
            $employeeTitles = $titles->where('category', 'employee')->pluck('name');
    
            if ($managerTitles->isEmpty() || $employeeTitles->isEmpty()) {
                Log::error("Error: Titles data is empty.");
                return response()->json(['error' => 'No titles found'], 500);
            }
    
            // Fetch managers based on dynamic titles
            $managers = $branch->employees()
                ->where('status', '1')
                ->whereIn('title', $managerTitles)
                ->orderByRaw("FIELD(title, " . $managerTitles->map(fn($title) => "'$title'")->join(',') . ")")
                ->get();
    
            // Fetch employees based on dynamic titles
            $employees = $branch->employees()
                ->where('status', '1')
                ->whereIn('title', $employeeTitles)
                ->orderByRaw("FIELD(title, " . $employeeTitles->map(fn($title) => "'$title'")->join(',') . ")")
                ->get();
    
            // Merge managers and employees
            $allEmployees = $managers->merge($employees);
    
            // Map to add default image paths
            $allEmployees->map(function ($employee) {
                $employee->image_path = $employee->image_path
                    ? asset('storage/' . ltrim($employee->image_path, '/'))
                    : asset('images/default.png');
                return $employee;
            });
    
            return response()->json($allEmployees, 200);
        } catch (\Exception $e) {
            Log::error("Error fetching employees: " . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch employees'], 500);
        }
    }
    
}
