<?php

namespace App\Models;

use Google\Service\WorkloadManager\Evaluation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employee_info';

    protected $fillable = ['name', 'branch_id', 'title', 'status', 'blood_type', 'marital_status', 'shift', 'whish_number', 'where_can_work', 'date_hired', 'pin_code', 'email', 'phone', 'car', 'address', 'image_path', 'job', 'left_date', 'left_reason', 'give_notice', 'is_good_performer', 'is_positive_person', 'exit_interview_remarks', 'is_recommended_to_back', 'birthday'];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function vacancy()
    {
        return $this->hasMany(Vacancy::class, 'employee_id');
    }

    public function promotion()
    {
        return $this->hasMany(Promotion::class, 'employee_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'head_of_dept_id');
    }

    public function jobRelation()
    {
        return $this->belongsTo(Job::class, 'job', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function answers()
    {
        return $this->hasMany(EvaluationAnswers::class, 'employee_id');
    }

}
