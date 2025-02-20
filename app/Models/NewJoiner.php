<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewJoiner extends Model
{

    use HasFactory;

    protected $table = 'new_joiner';

    protected $fillable = [
        'name',
        'mode',
        'date_mode',
        'job',
        'current_branch',
        'remarks'
    ];

    public function phaseProgress()
    {
        return $this->hasMany(EmployeePhaseProgress::class, 'employee_id');
    }
}
