<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationAnswers extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'made_by', 'form_id', 'question_id', 'answer', 'remarks', 'evaluation_id'];

    protected $table = 'evaluation_answers';

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id', 'id');
    }

    public function madeBy()
    {
        return $this->belongsTo(Employee::class, 'made_by');
    }

    public function form()
    {
        return $this->belongsTo(EvaluationForm::class, 'form_id');
    }

    public function question()
    {
        return $this->belongsTo(EvaluationFormQuestions::class, 'question_id');
    }

    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class, 'evaluation_id');
    }
}
