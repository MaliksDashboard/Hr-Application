<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\EvaluationForm;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use App\Models\EvaluationFormQuestions;

class EvaluationFormController extends Controller
{
    public function index()
    {
        $evaluationForms = EvaluationForm::withCount('questions')->get();
        return view('evaluationForms.index', compact('evaluationForms'));
    }

    public function create()
    {
        $departments = Department::orderBy('name', 'asc')->get();
        $jobs = Job::orderBy('name', 'asc')->get();
        $roles = Role::pluck('name'); // fetch all role names
        return view('evaluationForms.create', compact('departments', 'jobs','roles'));
    }

    public function store(Request $request)
    {
        Log::info('Request Data:', $request->all());

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'assigned_for' => 'required|string|max:255', // Ensure it's validated
            'dept_id' => 'nullable|exists:departments,id',
            'job' => 'required|exists:jobs_work,id',
            'question' => 'required|array',
            'question.*' => 'required|string|max:255',
        ]);

        Log::info('Validation Passed:', ['validated_data' => $validatedData]);

        // Create the evaluation form
        $form = EvaluationForm::create([
            'name' => $validatedData['name'],
            'assigned_for' => $validatedData['assigned_for'], // ✅ Ensure this is passed
            'dept_id' => $validatedData['dept_id'],
            'job' => $validatedData['job'],
        ]);

        Log::info('Form Created:', ['form_id' => $form->id]);

        // Insert multiple questions
        foreach ($validatedData['question'] as $index => $questionText) {
            EvaluationFormQuestions::create([
                'form_id' => $form->id,
                'question' => $questionText,
            ]);
            Log::info("Question $index Inserted", ['question_text' => $questionText]);
        }

        Log::info('Store Function Completed Successfully');

        return redirect()->route('evaluation-forms.index')->with('success', 'Form created successfully!');
    }

    public function edit($id)
    {
        $form = EvaluationForm::with('questions')->findOrFail($id);
        $departments = Department::all();
        $roles = Role::pluck('name'); // fetch all role names
        $jobs = Job::all();

        return view('evaluationForms.edit', compact('form', 'departments', 'jobs','roles'));
    }


    public function update(Request $request, $id)
    {
        Log::info('Starting update process for Evaluation Form ID: ' . $id);
    
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'assigned_for' => 'required|string|max:255',
            'dept_id' => 'nullable|exists:departments,id',
            'job' => 'required|exists:jobs_work,id',
            'question' => 'required|array',
            'question.*' => 'required|string|max:255',
        ]);
    
        Log::info('Validated data:', $validatedData);
    
        // Find the existing form
        $form = EvaluationForm::findOrFail($id);
        Log::info('Found Evaluation Form:', ['id' => $form->id, 'name' => $form->name]);
    
        $validatedData['dept_id'] = $request->dept_id === '' ? null : $validatedData['dept_id'];
        Log::info('Processed dept_id:', ['dept_id' => $validatedData['dept_id']]);
            
        // Update the form
        $form->update([
            'name' => $validatedData['name'],
            'assigned_for' => $validatedData['assigned_for'],
            'dept_id' => $validatedData['dept_id'], // Will be null if not provided
            'job' => $validatedData['job'],
        ]);
        Log::info('Updated Evaluation Form', ['form_id' => $form->id]);
    
        // Delete old questions and insert new ones
        Log::info('Deleting old questions for form ID:', ['form_id' => $form->id]);
        EvaluationFormQuestions::where('form_id', $form->id)->delete();
    
        foreach ($validatedData['question'] as $questionText) {
            Log::info('Inserting question:', ['form_id' => $form->id, 'question' => $questionText]);
    
            EvaluationFormQuestions::create([
                'form_id' => $form->id,
                'question' => $questionText,
            ]);
        }
    
        Log::info('Successfully updated Evaluation Form and questions.', ['form_id' => $form->id]);
    
        return redirect()->route('evaluation-forms.index')->with('success', 'Form updated successfully!');
    }
    
    public function destroy($id)
    {
        $form = EvaluationForm::findOrFail($id);
        $form->delete(); 
    
        return redirect()->route('evaluation-forms.index')->with('success', 'Form deleted successfully!');
    }
    
}
