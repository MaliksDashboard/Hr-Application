<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    protected $fillable = [
        'branch_id',
        'job',
        'asked_date',
        'completed_date',
        'status',
        'is_finished',
        'employee_id',
        'image_path',
        'remarks',
        'shift',
        'area',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
    public function jobRelation()
    {
        return $this->belongsTo(Job::class, 'job'); // ✅ Ensure 'job_id' is correct
    }
}
