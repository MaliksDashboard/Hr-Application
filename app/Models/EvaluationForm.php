<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Relations\Relation;

class EvaluationForm extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'assigned_for', 'dept_id', 'job'];

    protected $table = 'evaluation_forms';

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function job_evaluations()
    {
        return $this->belongsTo(Job::class, 'job', 'id')->with('users');
    }

    public function questions()
    {
        return $this->hasMany(EvaluationFormQuestions::class, 'form_id');
    }

    public function answers()
    {
        return $this->hasMany(EvaluationAnswers::class, 'form_id');
    }

    public static function boot()
    {
        parent::boot();

        static::retrieved(function ($model) {
            Log::info('EvaluationForm Retrieved:', ['assigned_for' => $model->assigned_for, 'job' => $model->job]);
        });

        static::saving(function ($model) {
            Log::info('EvaluationForm Saving:', $model->toArray());
        });

        static::updating(function ($model) {
            Log::info('EvaluationForm Updating:', $model->toArray());
        });

        static::deleting(function ($model) {
            Log::info('EvaluationForm Deleting:', ['id' => $model->id]);
        });

        static::saving(function ($model) {
            foreach ($model->getRelations() as $relation => $data) {
                Log::info('EvaluationForm Relation:', ['relation' => $relation, 'data' => $data]);
            }
        });
    }
}
