<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

    protected $table = 'transfers';

    protected $fillable = [
        'employee_id',
        'old_branch_id',
        'new_branch_id',
        'vacancy_id',
        'transfer_date',
        'transfer_start_date',
        'created_by',
        'type',
        'rotation_duration'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function oldBranch()
    {
        return $this->belongsTo(Branch::class, 'old_branch_id');
    }

    public function newBranch()
    {
        return $this->belongsTo(Branch::class, 'new_branch_id');
    }

    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
