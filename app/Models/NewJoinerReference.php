<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewJoinerReference extends Model
{
    use HasFactory;

    protected $casts = [
        'have_recommendation_letter' => 'boolean',
    ];

    protected $fillable = ['new_joiner_id', 'company_name', 'contact_name', 'phone', 'position', 'feedback', 'have_recommendation_letter'];

    public function newJoiner()
    {
        return $this->belongsTo(NewJoiner::class, 'new_joiner_id');
    }
}
