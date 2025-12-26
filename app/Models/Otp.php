<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Otp extends Model
{
    protected $fillable = [
        'identifier',
        'otp',
        'expires_at',
        'created_by',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function scopeValid(Builder $query): Builder
    {
        return $query->where('expires_at', '>=', now());
    }
}
