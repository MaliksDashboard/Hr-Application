<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $table = 'evaluations';

    protected $fillable = ['form_id', 'total_score', 'month', 'year', 'branch_id', 'employee_id', 'assigned_by','assigned_for'];

    public function answers()
    {
        return $this->hasMany(EvaluationAnswers::class, 'evaluation_id');
    }

    public function form()
    {
        return $this->belongsTo(EvaluationForm::class, 'form_id', 'id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function assignedByUser()
    {
        return $this->belongsTo(User::class, 'assigned_by', 'pin_code');
    }
    
}
