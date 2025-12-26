<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Institute extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
    ];

    protected $hidden = ['password'];

    public function students()
    {
        return $this->hasMany(Student::class, 'institute_id');
    }
}

