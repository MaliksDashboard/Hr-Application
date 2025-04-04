<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingSteps extends Model
{
    use HasFactory;

    protected $table = 'training_steps';

    protected $casts = [
        'is_reference_step' => 'boolean',
    ];

    protected $fillable = [
        'name',
        'step_order',
        'color',
        'type',
        'is_reference_step',
        'is_rollbackable',
    ];

    // Relationship: A step can be assigned to many new joiners in progress
    public function progress()
    {
        return $this->hasMany(NewJoinerProgress::class, 'step_id');
    }
}
