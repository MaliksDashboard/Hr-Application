<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'jobs_work';

    protected $fillable = ['name', 'dept_id'];

    public function department()
    {
        return $this->belongsTo(Department::class, 'dept_id');
    }

    public function employees()
    {
        return $this->hasMany(Employee::class, 'job', 'id');
    }

    public function evaluationForm()
    {
        return $this->belongsTo(EvaluationForm::class, 'job');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'job', 'id');
    }

    public function vacancies()
    {
        return $this->hasMany(Vacancy::class, 'job');
    }

    
}
