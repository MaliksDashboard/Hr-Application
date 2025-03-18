<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProbationPeriod extends Model
{

    use HasFactory;

    protected $table='employees_probation_period';

    protected $fillable = [
        'employee_id',
        'probation_period_end',
        'is_checked',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
