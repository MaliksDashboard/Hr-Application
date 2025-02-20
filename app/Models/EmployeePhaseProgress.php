<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePhaseProgress extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'phase', 'completed_at', 'next_phase_start_at'];

    public function employee()
    {
        return $this->belongsTo(NewJoiner::class, 'employee_id');
    }
}
