<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Branch;
use App\Models\Vacancy;
use App\Models\Employee;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\ProbationPeriod;
use App\Mail\NoticeAssessmentMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        $countEmployees = Employee::count();

        $countHeadOffice = Employee::whereHas('branch', function ($query) {
            $query->where('branch_name', 'Head Office');
        })->count();

        $countTeamLeader = Employee::whereHas('jobRelation', function ($query) {
            $query->where('name', 'Team Leader');
        })->count();

        $countBranches = Employee::whereHas('branch', function ($query) {
            $query->where('branch_name', '<>', 'Head Office');
        })->count();

        $noticeEmployees = DB::table('employees_probation_period')
            ->join('employee_info', 'employees_probation_period.employee_id', '=', 'employee_info.id')
            ->join('branches', 'employee_info.branch_id', '=', 'branches.id')
            ->where('employees_probation_period.is_checked', 0) // ✅ Fetch ONLY employees where is_checked = 0
            ->select('employee_info.id', 'employee_info.name', 'employee_info.image_path', 'employee_info.date_hired', 'employees_probation_period.probation_period_end', 'employees_probation_period.is_checked', 'branches.branch_name', 'branches.manager_email')
            ->orderBy('employees_probation_period.probation_period_end', 'asc') // ✅ Sort by probation end date (earliest first)
            ->get()
            ->map(function ($employee) {
                return [
                    'id' => $employee->id,
                    'name' => $employee->name,
                    'image_path' => $employee->image_path ?? 'images/default.jpg',
                    'date_hired' => Carbon::parse($employee->date_hired)->format('d-m-Y'),
                    'probation_end' => Carbon::parse($employee->probation_period_end)->format('d-m-Y'),
                    'branch_name' => $employee->branch_name ?? 'Unknown Branch',
                    'branch_email' => $employee->manager_email ?? 'No email found',
                    'is_checked' => $employee->is_checked, // ✅ Keep is_checked in output
                ];
            })
            ->toArray();

        $today = Carbon::now();
        $tomorrow = Carbon::now()->addDay();

        // Fetch employees whose anniversary is in the current month
        $workAnniversaries = Employee::whereMonth('date_hired', $today->month)
            ->select('id', 'name', 'date_hired', 'image_path', 'email') // Ensure email is selected
            ->get()
            ->map(function ($employee) use ($today) {
                $years = $today->year - Carbon::parse($employee->date_hired)->year;

                // Only include employees with at least 1 year of work
                if ($years < 1) {
                    return null;
                }

                return [
                    'name' => $employee->name,
                    'image_path' => $employee->image_path,
                    'years' => $years,
                    'anniversary_date' => Carbon::parse($employee->date_hired)->format('F d'),
                    'sort_date' => Carbon::parse($employee->date_hired)->day, // Extract day for sorting
                    'email' => $employee->email, // ✅ Include email field
                ];
            })
            ->filter() // Removes null values (employees with < 1 year)
            ->sortBy(function ($emp) use ($today) {
                if ($emp['sort_date'] == $today->day) {
                    return 0; // 🎉 Today’s anniversaries first
                } elseif ($emp['sort_date'] > $today->day) {
                    return $emp['sort_date']; // 🔜 Upcoming anniversaries next
                } else {
                    return $emp['sort_date'] + 100; // ⏳ Past anniversaries last
                }
            });

        // Fetch today's and upcoming birthdays (15 records max)
        $today = Carbon::now();
        $tomorrow = $today->copy()->addDay();

        // Fetch birthdays for this month
        $birthdays = Employee::select('employee_info.id', 'employee_info.name', 'employee_info.birthday', 'employee_info.image_path', 'employee_info.email', 'branches.branch_name')
            ->whereNotNull('employee_info.birthday') // Ensure birthday exists
            ->leftJoin('branches', 'employee_info.branch_id', '=', 'branches.id') // Join branches
            ->get()
            ->map(function ($emp) use ($today) {
                $birthday = Carbon::parse($emp->birthday)->setYear($today->year); // Adjust to this year

                // Only keep birthdays in this month
                if ($birthday->month !== $today->month) {
                    return null;
                }

                return [
                    'id' => $emp->id,
                    'name' => $emp->name,
                    'image_path' => $emp->image_path,
                    'branch' => $emp->branch_name ?? 'Unknown',
                    'birthday' => $birthday->format('d-m-Y'), // Format as dd-mm-yyyy
                    'age' => $today->year - Carbon::parse($emp->birthday)->year, // Age turning
                    'is_today' => $birthday->isToday(), // Highlight if today
                    'sort_date' => $birthday->day, // Extract day for sorting
                    'email' => $emp->email, // Add email for sending
                ];
            })
            ->filter() // Remove null values (if month doesn't match)
            ->sortBy(function ($emp) use ($today) {
                if ($emp['sort_date'] == $today->day) {
                    return 0; // 🎉 Today's birthdays first
                } elseif ($emp['sort_date'] > $today->day) {
                    return $emp['sort_date']; // 🔜 Upcoming birthdays next
                } else {
                    return $emp['sort_date'] + 100; // ⏳ Past birthdays last
                }
            });

        $employeeEvaluations = [['employee_name' => 'John Doe', 'department' => 'IT', 'score' => 85], ['employee_name' => 'Sarah Ali', 'department' => 'Marketing', 'score' => 92], ['employee_name' => 'Michael Smith', 'department' => 'Finance', 'score' => 78], ['employee_name' => 'Emily Johnson', 'department' => 'HR', 'score' => 88], ['employee_name' => 'Ahmed Khalid', 'department' => 'Operations', 'score' => 70], ['employee_name' => 'Jessica Lee', 'department' => 'Sales', 'score' => 95], ['employee_name' => 'Omar Hassan', 'department' => 'Customer Support', 'score' => 80], ['employee_name' => 'Fatima Noor', 'department' => 'Design', 'score' => 89], ['employee_name' => 'David Brown', 'department' => 'Legal', 'score' => 75], ['employee_name' => 'Ali Zain', 'department' => 'Engineering', 'score' => 90]];

        // Pass data to the view
        return view('dashboard', compact('countEmployees', 'countHeadOffice', 'countTeamLeader', 'countBranches', 'noticeEmployees', 'workAnniversaries', 'birthdays', 'employeeEvaluations'));
    }

    public function getVaccanciesData()
    {
        // ✅ Fetch vacancies with their related job
        $vacancies = Vacancy::with('jobRelation') // Eager load jobRelation
            ->where('is_finished', 0) // ✅ Ensure 'is_finished' is checked as an integer
            ->get();

        // ✅ Group by job name from the Job table
        $jobCounts = $vacancies->groupBy(fn($vacancy) => strtolower(optional($vacancy->jobRelation)->name ?? 'Unknown'))->map(fn($group) => $group->count());

        return response()->json($jobCounts);
    }

    public function sendAniversaryEmail(Request $request)
    {
        if (!$request->has('email') || !$request->has('name')) {
            return response()->json(['message' => 'Invalid request'], 400);
        }

        $email = $request->email;
        $name = $request->name;

        // Find the employee's hiring date from the database
        $employee = Employee::where('email', $email)->first();

        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        // Calculate years of service
        $years = Carbon::now()->year - Carbon::parse($employee->date_hired)->year;

        // Send email with years of service
        Mail::send('emails.anniversary', ['name' => $name, 'years' => $years], function ($message) use ($email, $name) {
            $message->to($email)->subject("🎉 Happy Work Anniversary, $name!");
        });

        return response()->json(['message' => "Email sent successfully to $name!"]);
    }

    public function sendBirthdayEmail(Request $request)
    {
        if (!$request->has('email') || !$request->has('name')) {
            return response()->json(['message' => 'Invalid request'], 400);
        }

        $email = $request->email;
        $name = $request->name;

        Mail::send('emails.birthday', ['name' => $name], function ($message) use ($email, $name) {
            $message->to($email)->subject("🎂 Happy Birthday, $name!");
        });

        return response()->json(['message' => "Birthday email sent successfully to $name!"]);
    }

    public function sendNoticeAssessmentEmail(Request $request)
    {
        // Log the incoming request data
        Log::info('Received request for sending email', ['request_data' => $request->all()]);

        try {
            // Validate the request
            $validated = $request->validate([
                'employee_id' => 'required|integer', // Make sure we receive the employee ID
                'name' => 'required|string',
                'branch' => 'required|string',
                'email' => 'required|email',
            ]);

            Log::info('Validated request data', ['validated_data' => $validated]);

            // Send the email
            Mail::to($validated['email'])
                ->cc(['hr@maliks.com', 'hr1@maliks.com', 'hr2@maliks.com', 'hr3@maliks.com'])
                ->send(new NoticeAssessmentMail($validated['name'], $validated['branch']));

            Log::info('Email sent successfully to ' . $validated['email']);

            // ✅ Update the `is_checked` column in the database
            ProbationPeriod::where('employee_id', $validated['employee_id'])->update(['is_checked' => 1]);

            Log::info('Updated is_checked to 1 for employee_id: ' . $validated['employee_id']);

            return response()->json(['message' => 'Notice email sent successfully!']);
        } catch (\Exception $e) {
            // Log the error if sending fails
            Log::error('Failed to send email', [
                'error_message' => $e->getMessage(),
                'request_data' => $request->all(),
            ]);

            return response()->json(['message' => 'Failed to send email: ' . $e->getMessage()], 500);
        }
    }

    public function getTopBranches()
    {
        $topBranches = Branch::withCount('employees')
            ->orderByDesc('employees_count')
            ->limit(10)
            ->get(['name', 'employees_count']);

        return response()->json($topBranches);
    }
}
