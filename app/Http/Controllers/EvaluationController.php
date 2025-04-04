<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Department;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use App\Models\EvaluationForm;
use App\Models\EvaluationChain;
use App\Models\EvaluationAnswers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\EvaluationFormQuestions;

class EvaluationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userRole = $user->getRoleNames()->first();

        // Group evaluations by year
        $evaluations = Evaluation::where(function ($q) use ($user) {
            $q->where('assigned_by', $user->pin_code)->orWhere('employee_id', $user->id); // just in case you track both
        })
            ->get()
            ->groupBy('year');

        $currentMonth = now()->month;
        $currentYear = now()->year;
        $currentDay = now()->day;

        return view('evaluation.index', compact('evaluations', 'currentMonth', 'currentYear', 'currentDay', 'userRole'));
    }

    public function show($month)
    {
        $user = Auth::user();
        $currentYear = now()->year;
        $currentMonth = now()->month;
        $currentDay = now()->day;
        $userRole = $user->getRoleNames()->first();
        $isSMC = $userRole === 'SMC';

        // Start with blank and build only valid employees
        $allEmployees = collect();

        $chains = EvaluationChain::where('evaluator_role', $userRole)->get();

        foreach ($chains as $chain) {
            $query = User::with(['roles', 'jobRelation', 'employee'])
                ->where('id', '!=', $user->id)
                ->whereHas('roles', fn($q) => $q->where('name', $chain->target_role));

            // 🔒 If target is "Branch Employee" → must be from same branch | Branch Manager
            if ($chain->evaluator_role === 'Branch Manager' && $chain->target_role === 'Branch Employee') {
                $query->where('branch_id', $user->branch_id);
            }

            // 🔒 If Branch Manager evaluates Department Supervisor (no restriction)
            if ($chain->evaluator_role === 'Branch Manager' && $chain->target_role === 'Department Supervisor') {
            }

            // 🔒 Department Manager evaluating Branch Employees with special condition for job 6
            if ($chain->evaluator_role === 'Department Manager' && $chain->target_role === 'Branch Employee') {
                $deptId = optional($user->employee)->belongs_to;

                $query->where(function ($q) use ($deptId) {
                    if (in_array($deptId, [1, 2, 4])) {
                        $q->whereHas('jobRelation', fn($subQ) => $subQ->where('dept_id', $deptId))->orWhere(function ($q2) {
                            $q2->where('job', 6);
                        });
                    } else {
                        $q->whereHas('jobRelation', fn($subQ) => $subQ->where('dept_id', $deptId));
                    }
                });
            }

            // 🔒 Department Manager evaluating Department Employees only:
            if ($chain->evaluator_role === 'Department Manager' && $chain->target_role === 'Department Employee') {
                $deptId = optional($user->employee)->belongs_to;

                $query->whereHas('jobRelation', function ($q) use ($deptId) {
                    $q->where('dept_id', $deptId)->orderBy('job', 'asc');
                });
            }

            // 🔒 Department Manager evaluating Supervisors or Visitors → must match department
            if ($chain->evaluator_role === 'Department Manager' && in_array($chain->target_role, ['Department Supervisor', 'Department Supervisor Visitor'])) {
            }

            // 🔒 If job_id is set in the chain
            if ($chain->job_id) {
                $query->where('job', $chain->job_id);
            }

            // 🔒 If department_id is set in the chain
            if ($chain->department_id) {
                $query->where(function ($q) use ($chain) {
                    $q->whereHas('employee', fn($q2) => $q2->where('belongs_to', $chain->department_id))->orWhereHas('jobRelation', fn($q2) => $q2->where('dept_id', $chain->department_id));
                });
            }

            $allEmployees = $allEmployees->merge($query->get());
        }

        // Remove duplicates
        $allEmployees = $allEmployees->unique('id');

        // Prepare output buckets
        $byManager = collect();
        $byEmployee = collect();
        $departmentManagers = collect();
        $departmentSupervisors = collect();
        $deptBranchEmployees = collect();

        $smc_departmentManagers = collect();
        $smc_departmentSupervisors = collect();
        $smc_branchManagers = collect();
        $smc_branchSupervisors = collect();

        if ($userRole === 'Department Manager') {
            $userDeptId = optional($user->employee)->belongs_to;

            $myTeam = User::with(['roles', 'jobRelation', 'employee'])
                ->where('id', '!=', $user->id)
                ->whereHas('employee', fn($q) => $q->where('belongs_to', $userDeptId))
                ->get();

            foreach ($myTeam as $employee) {
                $employee->assigned_for = 'Department Manager';
                $employee->evaluation = Evaluation::where('employee_id', $employee->id)
                    ->where('month', $month)
                    ->where('year', $currentYear)
                    ->where('assigned_for', $userRole) // 👈 THIS LINE IS CRUCIAL
                    ->first();

                $byManager->push($employee); // ❤️ This fills the My Team section in the blade
            }
        }

        foreach ($chains as $chain) {
            foreach ($allEmployees as $employee) {
                if ($employee->getRoleNames()->first() !== $chain->target_role) {
                    continue;
                }

                // Check for department match (if set in the rule)
                if ($chain->department_id) {
                    $targetDeptId = optional($employee->employee)->belongs_to ?? optional($employee->jobRelation)->dept_id;
                    $userDeptId = optional($user->employee)->belongs_to;

                    if ($targetDeptId != $chain->department_id && $userDeptId != $chain->department_id) {
                        continue;
                    }
                }

                // Check for job match (if set in the rule)
                if ($chain->job_id && $employee->job != $chain->job_id) {
                    continue;
                }

                // 🧠 Skip if skip_if_done_by_higher is true AND higher priority rule already evaluated
                if ($chain->skip_if_done_by_higher) {
                    $higherExists = \App\Models\EvaluationChain::where('target_role', $chain->target_role)->where('priority', '<', $chain->priority)->pluck('evaluator_role');

                    $alreadyEvaluated = \App\Models\Evaluation::where('employee_id', $employee->id)
                        ->where('month', $month)
                        ->where('year', $currentYear)
                        ->whereHas('assignedByUser', function ($q) use ($higherExists) {
                            $q->whereIn('role', $higherExists);
                        })
                        ->exists();

                    if ($alreadyEvaluated) {
                        continue;
                    }
                }

                // ✅ All checks passed: attach data
                $employee->assigned_for = $chain->evaluator_role;
                $employee->evaluation = Evaluation::where('employee_id', $employee->id)
                    ->where('month', $month)
                    ->where('year', $currentYear)
                    ->where('assigned_for', $userRole) // 👈 THIS LINE IS CRUCIAL
                    ->first();

                // 🔄 You can categorize however you want below
                if ($chain->evaluator_role === 'Branch Manager' && $chain->target_role === 'Branch Employee') {
                    $byManager->push($employee);
                } elseif ($chain->target_role === 'Department Manager') {
                    $departmentManagers->push($employee);
                } elseif (($chain->evaluator_role === 'Department Manager' && in_array($chain->target_role, ['Department Supervisor', 'Department Supervisor Visitor'])) || ($chain->evaluator_role === 'Branch Manager' && $chain->target_role === 'Department Supervisor')) {
                    $departmentSupervisors->push($employee);
                } elseif ($chain->evaluator_role === 'Department Manager' && $chain->target_role === 'Branch Employee') {
                    $deptId = optional($user->employee)->belongs_to;

                    if (optional($employee->jobRelation)->dept_id == $deptId || ($employee->job == 6 && in_array($deptId, [1, 2, 4]))) {
                        $deptBranchEmployees->push($employee);
                    }
                }

                if ($isSMC) {
                    if ($chain->target_role === 'Department Manager') {
                        $smc_departmentManagers->push($employee);
                    } elseif (in_array($chain->target_role, ['Department Supervisor', 'Department Supervisor Visitor'])) {
                        $smc_departmentSupervisors->push($employee);
                    } elseif ($chain->target_role === 'Branch Manager') {
                        $smc_branchManagers->push($employee);
                    } elseif ($chain->target_role === 'Branch Supervisor') {
                        $smc_branchSupervisors->push($employee);
                    }
                }

                // 📌 For Stationery (job_id = 5): Handle self-eval
                if ($employee->job == 5 && $chain->target_role === 'Branch Employee' && $chain->evaluator_role === 'Branch Manager') {
                    $managerEval = $employee->evaluation;
                    $selfEval = Evaluation::where('employee_id', $employee->id)->where('month', $month)->where('year', $currentYear)->whereHas('form', fn($q) => $q->where('assigned_for', 'Employee'))->first();

                    $copy = clone $employee;
                    $copy->assigned_for = 'Employee';
                    $copy->evaluation = $selfEval;

                    $byManager->push($employee); // For manager
                    $byEmployee->push($copy); // For self-evalS
                }
            }
        }

        return view('evaluation.show', compact('byManager', 'byEmployee', 'departmentManagers', 'departmentSupervisors', 'deptBranchEmployees', 'month', 'currentYear', 'currentMonth', 'currentDay', 'userRole', 'isSMC', 'smc_departmentManagers', 'smc_departmentSupervisors', 'smc_branchManagers', 'smc_branchSupervisors'));
    }

    public function evaluate($month, $employee_id, $assigned_for)
    {
        $user = Auth::user();
        $currentYear = now()->year;

        // Get the employee
        $employee = User::findOrFail($employee_id);

        // Get evaluation form by job ID
        $formId = EvaluationForm::where('assigned_for', $assigned_for)
            ->where(function ($q) use ($employee) {
                $q->where('job', $employee->job)->orWhere('dept_id', optional($employee->jobRelation)->dept_id);
            })
            ->value('id');

        if (!$formId) {
            return redirect()->back()->with('error', 'No evaluation form found for this employee.');
        }

        // Get or create the evaluation
        $evaluation = Evaluation::firstOrCreate(
            [
                'employee_id' => $employee->id,
                'branch_id' => $user->branch_id,
                'month' => $month,
                'year' => $currentYear,
                'form_id' => $formId,
                'assigned_for' => $assigned_for,
            ],
            [
                'total_score' => null,
                'assigned_by' => $user->pin_code,
            ],
        );

        // Get all branch employees excluding the evaluator
        $employees = User::where('branch_id', $user->branch_id)->where('id', '!=', $user->id)->orderBy('job', 'asc')->get();

        // Find index
        $currentIndex = $employees->search(fn($emp) => $emp->id == $employee_id);
        $prevEmployee = $employees[$currentIndex - 1] ?? null;
        $nextEmployee = $employees[$currentIndex + 1] ?? null;

        // Attach evaluation to prev/next
        if ($prevEmployee) {
            $prevEmployee->evaluation = Evaluation::where([
                'employee_id' => $prevEmployee->id,
                'branch_id' => $user->branch_id,
                'month' => $month,
                'year' => $currentYear,
                'assigned_for' => $assigned_for, // ✅ Add this!
            ])->first();
        }

        if ($nextEmployee) {
            $nextEmployee->evaluation = Evaluation::where('employee_id', $nextEmployee->id)->where('branch_id', $user->branch_id)->where('month', $month)->where('year', $currentYear)->first();
        }

        // Get the questions
        $questions = EvaluationFormQuestions::where('form_id', $evaluation->form_id)->get();

        return view('evaluation.evaluate', compact('evaluation', 'employee', 'questions', 'month', 'prevEmployee', 'nextEmployee'));
    }

    public function edit($evaluation_id, $employee_id)
    {
        $evaluation = Evaluation::findOrFail($evaluation_id);
        $employee = User::findOrFail($employee_id);
        $questions = EvaluationFormQuestions::where('form_id', $evaluation->form_id)->get();
        $answers = EvaluationAnswers::where('evaluation_id', $evaluation_id)->pluck('answer', 'question_id');
        $month = $evaluation->month;

        // Get all employees in the same branch except the evaluator
        $branchEmployees = User::where('branch_id', $employee->branch_id)->where('id', '!=', Auth::id())->orderBy('job', 'asc')->get();

        // Find current index
        $currentIndex = $branchEmployees->search(fn($emp) => $emp->id == $employee_id);

        $prevEmployee = $branchEmployees[$currentIndex - 1] ?? null;
        $nextEmployee = $branchEmployees[$currentIndex + 1] ?? null;

        // ✅ Attach evaluations to prev/next
        if ($prevEmployee) {
            $prevEmployee->evaluation = Evaluation::where('employee_id', $prevEmployee->id)->where('branch_id', $employee->branch_id)->where('month', $month)->where('year', now()->year)->first();
        }

        if ($nextEmployee) {
            $nextEmployee->evaluation = Evaluation::where('employee_id', $nextEmployee->id)->where('branch_id', $employee->branch_id)->where('month', $month)->where('year', now()->year)->first();
        }

        return view('evaluation.edit_evaluate', compact('evaluation', 'employee', 'questions', 'answers', 'month', 'prevEmployee', 'nextEmployee'));
    }

    public function updateEvaluation(Request $request, $evaluation_id, $employee_id)
    {
        $evaluation = Evaluation::findOrFail($evaluation_id);

        $totalScore = 0;
        $questionCount = 0;

        foreach ($request->answers as $question_id => $answer) {
            EvaluationAnswers::updateOrCreate(
                [
                    'employee_id' => $employee_id,
                    'made_by' => Auth::id(),
                    'form_id' => $evaluation->form_id,
                    'evaluation_id' => $evaluation_id,
                    'question_id' => $question_id,
                ],
                [
                    'answer' => $answer,
                ],
            );

            $totalScore += $answer;
            $questionCount++;
        }

        // Normalize the score
        $maxScore = $questionCount * 4;
        $finalScore = ($totalScore / $maxScore) * 100;

        // Save updated total
        $evaluation->update(['total_score' => $finalScore]);
        $evaluation->update(['assigned_by' => Auth::user()->pin_code]);

        return redirect()
            ->route('evaluation.editScore', [
                'evaluation_id' => $evaluation_id,
                'employee_id' => $employee_id,
            ])
            ->with('success', 'Evaluation updated successfully!');
    }

    public function submitEvaluation(Request $request, $evaluation_id, $employee_id)
    {
        $user = Auth::user();
        $evaluation = Evaluation::findOrFail($evaluation_id);

        // Ensure evaluation was meant to be done by current role
        $assignedFor = $evaluation->assigned_for ?? $user->getRoleNames()->first();

        $totalScore = 0;
        $questionCount = 0;

        foreach ($request->answers as $question_id => $answer) {
            EvaluationAnswers::updateOrCreate(
                [
                    'employee_id' => $employee_id,
                    'made_by' => $user->id,
                    'form_id' => $evaluation->form_id,
                    'evaluation_id' => $evaluation->id,
                    'question_id' => $question_id,
                ],
                [
                    'answer' => $answer,
                ],
            );

            $totalScore += $answer;
            $questionCount++;
        }

        // Normalize to 100
        $maxScore = $questionCount * 4;
        $finalScore = round(($totalScore / $maxScore) * 100, 2);

        // Update main evaluation record
        $evaluation->update([
            'total_score' => $finalScore,
            'assigned_by' => $user->pin_code,
            'assigned_for' => $assignedFor,
        ]);

        return redirect()
            ->route('evaluation.evaluate', [
                'month' => $evaluation->month,
                'employee_id' => $employee_id,
                'assigned_for' => $assignedFor,
            ])
            ->with('success', 'Evaluation submitted successfully!');
    }

    public function viewEvaluation($evaluation_id, $employee_id)
    {
        Log::info('View Evaluation Route Called', ['evaluation_id' => $evaluation_id, 'employee_id' => $employee_id]);

        if (!$evaluation_id || !$employee_id) {
            return redirect()->back()->with('error', 'Invalid evaluation request.');
        }

        $evaluation = Evaluation::findOrFail($evaluation_id);
        $employee = User::findOrFail($employee_id);
        $answers = EvaluationAnswers::where('evaluation_id', $evaluation_id)->where('employee_id', $employee_id)->get();

        return view('evaluation.view', compact('evaluation', 'employee', 'answers'));
    }
}
