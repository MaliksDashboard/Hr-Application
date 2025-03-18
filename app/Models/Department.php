<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = 'departments';

    protected $fillable = ['name', 'head_of_dept_id'];

    public function headOfDept()
    {
        return $this->belongsTo(Employee::class,'head_of_dept_id');
    }

    public function jobs()
    {
        return $this->belongsTo(Job::class,'dept_id');
    }

    public function evaluationForm(){
        return $this->belongsTo(EvaluationForm::class,'dept_id');
    }
}
