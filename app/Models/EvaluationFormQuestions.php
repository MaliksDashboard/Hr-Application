<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationFormQuestions extends Model
{
    use HasFactory;
    protected $fillable = ['form_id', 'question'];

    protected $table = 'evaluation_form_questions';

    public function answers()
    {
        return $this->hasMany(EvaluationAnswers::class, 'question_id');
    }
}
