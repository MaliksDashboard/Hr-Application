<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{


    use HasFactory;

    protected $table = 'table_promotions';
    protected $fillable = [
        'employee_id',
        'old_title',
        'new_title',
        'promotion_date'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
