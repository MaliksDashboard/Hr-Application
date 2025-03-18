<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewJoinerProgress extends Model
{
    use HasFactory;

    protected $table = 'new_joiner_progress';

    protected $fillable = ['new_joiner_id', 'step_id', 'status', 'completed_at', 'remarks', 'interview_time'];

    // Relationship with NewJoiner
    public function newJoiner()
    {
        return $this->belongsTo(NewJoiner::class, 'new_joiner_id');
    }

    // Relationship with TrainingSteps
    public function step()
    {
        return $this->belongsTo(TrainingSteps::class)->withDefault([
            'name' => 'Step Deleted',
            'step_order' => 9999,
            'color' => '#ccc',
        ]);
    }
}
