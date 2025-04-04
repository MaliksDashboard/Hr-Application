<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluationChain extends Model
{
    protected $fillable = [
        'evaluator_role',
        'target_role',
        'job_id',
        'department_id',
        'priority',
        'skip_if_done_by_higher',
    ];

    // Relationship with Job
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    // Relationship with Department
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }}
