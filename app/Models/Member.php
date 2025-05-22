<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
     protected $fillable = [
        'first_name',
        'last_name',
        'rut',
        'email',
        'phone',
        'address',
        'birth_date',
        'join_date',
        'is_active',    // si luego permites togglear este valor
    ];
}
