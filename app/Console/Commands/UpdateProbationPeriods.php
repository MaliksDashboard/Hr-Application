<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Employee;
use App\Models\ProbationPeriod;
use Carbon\Carbon;

class UpdateProbationPeriods extends Command
{
    protected $signature = 'update:probation-periods';
    protected $description = 'Update the probation period end date for employees and mark those with more than 100 days as checked';

    public function handle()
    {
        $employees = Employee::all(); // Fetch all employees

        foreach ($employees as $employee) {
            // Calculate probation end date (date hired + 90 days)
            $probationEndDate = Carbon::parse($employee->date_hired)->addDays(90)->format('Y-m-d');

            // Calculate number of days worked
            $daysWorked = Carbon::parse($employee->date_hired)->diffInDays(Carbon::now());

            // If worked more than 100 days, mark as checked (1), else keep it unchecked (0)
            $isChecked = $daysWorked > 100 ? 1 : 0;

            // Ensure the record exists or update it
            ProbationPeriod::updateOrCreate(
                ['employee_id' => $employee->id], // Match by employee ID
                [
                    'probation_period_end' => $probationEndDate, // Ensure this field is always provided
                    'is_checked' => $isChecked
                ]
            );
        }

        $this->info('Probation periods updated. Employees with more than 100 days are marked as checked.');
    }
}
