<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {
        // Fetch all employees from the 'employee_info' table
        $employees = DB::table('employee_info')->get();

        // Define categories for durations
        $categories = [
            'Legendary' => ['min' => 30, 'max' => null], // More than 30 years
            'Heroes' => ['min' => 20, 'max' => 30],     // More than 20 years
            'Experts' => ['min' => 10, 'max' => 20],    // More than 10 years
            'Professionals' => ['min' => 5, 'max' => 10], // More than 5 years
            'Experienced' => ['min' => 1, 'max' => 5],  // More than 1 year
            'New Hired' => ['min' => 0, 'max' => 1]     // Less than 1 year
        ];

        // Roles to display
        $roles = ['Manager', 'Graphic Designer', 'Services', 'Stationery', 'Cashier', 'Back Office'];

        // Initialize the result array
        $data = [];

        foreach ($roles as $role) {
            // Initialize role data
            $data[$role] = array_fill_keys(array_keys($categories), 0);

            // Filter employees by role
            $employeesByRole = $employees->filter(function ($employee) use ($role) {
                return $employee->job === $role;
            });

            // Categorize employees by duration
            foreach ($employeesByRole as $employee) {
                $years = Carbon::parse($employee->date_hired)->diffInYears(Carbon::now());

                foreach ($categories as $category => $range) {
                    if (
                        ($range['min'] === null || $years >= $range['min']) &&
                        ($range['max'] === null || $years < $range['max'])
                    ) {
                        $data[$role][$category]++;
                        break;
                    }
                }
            }
        }

        // Pass data to the view
        return view('dashboard', compact('data'));
    }
}
