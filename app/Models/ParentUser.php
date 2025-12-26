<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Student;

class ParentUser extends Authenticatable
{
    use Notifiable;

    protected $table = 'parents';

    protected $fillable = [
        'name',
        'mobile',
        'password',
        'is_active',
    ];

    protected $hidden = [
        'password',
    ];

    /* ======================
       RELATIONSHIPS
    ====================== */

    public function students()
    {
        return $this->hasMany(Student::class, 'parent_id');
    }

    /* ======================
       HELPERS
    ====================== */

    public function totalDueAmount()
    {
        return $this->students
            ->flatMap(fn ($student) => $student->unpaidDues)
            ->sum('amount');
    }
}
