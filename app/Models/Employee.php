<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    use HasFactory;

    protected $table = 'employee_info';

    protected $fillable = [
        'name',
        'branch_id',
        'title',
        'status',
        'date_hired',
        'pin_code',
        'email',
        'phone',
        'image_path',
        'job',
        'left_date',
    ];

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
}
