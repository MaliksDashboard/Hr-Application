<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user()->load(['employee.branch', 'employee.jobRelation']);
        $branchId = $user->employee?->branch_id;
        $branch = $user->employee?->branch; // ✅ this is what was missing

        // Load employees with job, and manually join titles to get rank
        $employees = DB::table('employee_info as e')
            ->leftJoin('titles as t', 'e.title', '=', 't.name')
            ->leftJoin('jobs_work as j', 'e.job', '=', 'j.id')
            ->where('e.branch_id', $branchId)
            ->select('e.*', 't.rank as title_rank', 'j.name as job_name')
            ->orderByRaw('COALESCE(t.rank, 999)')
            ->get();

        // You can convert to collection of objects if needed
        $employees = collect($employees);

        // Total employees
        $totalEmployees = $employees->count();

        // Team leaders only
        $teamLeaders = $employees->filter(fn($emp) => strtolower($emp->job_name) === 'team leader');

        // Employees grouped by job name
        $employeesByJob = $employees
            ->groupBy('job_name')
            ->map(fn($group) => $group->count())
            ->toArray();

        // Upcoming birthdays (within next 7 days)
        $birthdays = $employees->filter(function ($emp) {
            if (!$emp->birthday) return false;
            $birthday = Carbon::parse($emp->birthday)->setYear(now()->year);
            return $birthday->isBetween(now(), now()->addDays(30));
        })->sortBy(fn($emp) => Carbon::parse($emp->birthday)->format('m-d'));

        return view('home', compact(
            'user',
            'branch',
            'employees',
            'totalEmployees',
            'teamLeaders',
            'employeesByJob',
            'birthdays'
        ));
    }
}
