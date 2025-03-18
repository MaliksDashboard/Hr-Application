<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class SyncEmployeesToUsers extends Command
{
    protected $signature = 'sync:employees';
    protected $description = 'Create user accounts for employees in the employee_info table and assign roles';

    public function handle()
    {
        $employees = Employee::all();

        foreach ($employees as $employee) {
            if (empty($employee->id)) {
                $this->error("SKIPPING: Employee ID is missing for {$employee->name}");
                continue;
            }

            $this->info("Processing Employee: {$employee->name}, Job: {$employee->job}, Branch: {$employee->branch_id}");

            // Ensure email is never NULL
            $email = $employee->email ?: "no-email-{$employee->id}@example.com";

            // Generate a temporary password
            $tempPass = 'Welcome@123';

            // Create or update the user
            $user = User::updateOrCreate(
                ['employee_id' => $employee->id],
                [
                    'employee_id' => $employee->id,
                    'name' => $employee->name,
                    'email' => $email,
                    'password' => Hash::make($tempPass),
                    'temp_pass' => $tempPass,
                    'pin_code' => $employee->pin_code,
                    'image' => $employee->image_path,
                    'status' => 'active',
                    'job' => $employee->job,
                    'branch_id' => $employee->branch_id,
                ],
            );

            // **Determine Role Based on Job Title and Branch**
            $role = $this->determineRole($employee->job, $employee->branch_id);

            // Assign role using Spatie Permissions
            if ($role) {
                $user->syncRoles([$role]);
                $this->info("Assigned Role: {$role} to {$user->name}");
            } else {
                $this->warn("No role assigned for {$user->name}");
            }
        }

        $this->info('Users synced and roles assigned successfully!');
    }

    // **Function to Determine Role**
    private function determineRole($job, $branch)
    {
        $branchName = strtolower($branch); // Convert branch name to lowercase to avoid case sensitivity
        $isDepartment = str_contains($branchName, 'department'); // Check if branch name contains "department"
        $isTeamLeader = str_contains(strtolower($job), 'team leader'); // Check if job title contains "team leader"

        if ($isTeamLeader && !$isDepartment) {
            return 'Branch Manager';
        } elseif (!$isTeamLeader && !$isDepartment) {
            return 'Branch Employee';
        } elseif ($isTeamLeader && $isDepartment) {
            return 'Branch Department';
        } elseif (!$isTeamLeader && $isDepartment) {
            return 'Department Employee';
        }

        return null; // Default to no role if no condition matches
    }
}
