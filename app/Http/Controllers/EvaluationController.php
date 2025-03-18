<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\EvaluationAnswers;
use App\Models\EvaluationForm;
use App\Models\EvaluationFormQuestions;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EvaluationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $evaluations = Evaluation::where('branch_id', $user->branch_id)->get();

        // Prevent errors if no evaluations exist
        if ($evaluations->isEmpty()) {
            $evaluations = collect(); // Return an empty collection instead of null
        }

        return view('evaluation.index', compact('evaluations'));
    }

    public function startEvaluation($month)
    {
        $user = Auth::user();
        $currentYear = now()->year;

        // Check if evaluation exists
        $evaluation = Evaluation::firstOrCreate(
            [
                'branch_id' => $user->branch_id,
                'month' => $month,
                'year' => $currentYear,
            ],
            [
                'total_score' => null,
            ],
        );

        // Redirect to show the employees for evaluation
        return redirect()->route('evaluation.show', ['month' => $month]);
    }

    public function show($month)
    {
        $user = Auth::user();
        $currentYear = now()->year;

        Log::info('Show Evaluation Page Opened', ['user_id' => $user->id, 'month' => $month]);

        // Get employees of the branch
        $employees = User::where('branch_id', $user->branch_id)->get();

        return view('evaluation.show', compact('employees', 'month', 'currentYear'));
    }

    public function evaluate($month, $employee_id)
    {
        $user = Auth::user();
        $currentYear = now()->year;

        $employee = User::findOrFail($employee_id);

        $formId = EvaluationForm::where('assigned_for', 'Branch Manager')->where('job', $employee->job)->value('id');

        if (!$formId) {
            return redirect()->back()->with('error', 'No evaluation form found for the employee’s job.');
        }

        // Check if evaluation already exists for THIS employee in THIS month/year
        $evaluation = Evaluation::firstOrCreate(
            [
                'employee_id' => $employee->id,
                'branch_id' => $user->branch_id,
                'month' => $month,
                'year' => $currentYear,
            ],
            [
                'form_id' => $formId,
                'total_score' => null,
            ],
        );
        // Check if employee already answered
        $existingAnswers = EvaluationAnswers::where([
            'evaluation_id' => $evaluation->id,
            'employee_id' => $employee_id,
        ])->exists();

        if ($existingAnswers) {
            return redirect()->route('evaluation.view', [
                'evaluation_id' => $evaluation->id,
                'employee_id' => $employee_id,
            ]);
        }

        // Fetch questions using the evaluation form ID
        $questions = EvaluationFormQuestions::where('form_id', $evaluation->form_id)->get();

        return view('evaluation.evaluate', compact('evaluation', 'employee', 'questions', 'month'));
    }

    public function submitEvaluation(Request $request, $evaluation_id, $employee_id)
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

        // Normalize the score to a percentage
        $maxScore = $questionCount * 4;
        $finalScore = ($totalScore / $maxScore) * 100;

        // Save the total score
        $evaluation->update(['total_score' => $finalScore]);

        return redirect()
            ->route('evaluation.show', ['month' => $evaluation->month])
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
