<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $fillable = ['branch_name', 'location', 'manager_email', 'services_gmail', 'latitude', 'longitude'];

    public function employees()
    {
        return $this->hasMany(Employee::class, 'branch_id', 'id');
    }

    public function vacancies()
    {
        return $this->hasMany(Vacancy::class, 'branch_id', 'id'); 
    }
    
}
