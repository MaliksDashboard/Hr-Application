<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as SpatieRole; // Add this import

class Role extends SpatieRole
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = ['name'];
}
