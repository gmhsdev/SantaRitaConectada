<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MemberDocument extends Model
{
    protected $fillable = [
        'member_id',
        'document_name',
        'document_path',
    ];

    /**
     * Relación con el socio (Member)
     */
    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }
}
