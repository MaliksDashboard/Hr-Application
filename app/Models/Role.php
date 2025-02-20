<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory, HasRoles;

    protected $table = 'roles';  
    protected $guard_name = 'web';  
    protected $fillable=['name','guard_name'];

    
}
