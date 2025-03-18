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
        'start_date',
        'job',
        'target_branch',
    ];

    // Relationship: A new joiner has many progress records (each step)
    public function progress()
    {
        return $this->hasMany(NewJoinerProgress::class, 'new_joiner_id');
    }

    public function jobRelation()
    {
        return $this->belongsTo(Job::class, 'job');
    }
}
