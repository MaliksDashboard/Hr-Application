<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'message',
        'notified_at',
        'is_read',
        'user_image',
    ];

    protected $casts = [
        'notified_at' => 'datetime',
        'is_read' => 'boolean',
    ];

    // Relationship: Each notification belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
