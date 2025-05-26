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
        'is_active',
    ];

    // Relación con los documentos
    public function documents()
    {
        return $this->hasMany(MemberDocument::class);
    }
}
