<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use Notifiable;

    protected $table = 'students';

    protected $fillable = [
        'institute_id',
        'parent_id',        // ✅ ADD THIS
        'name',
        'parent_name',
        'mobile',
        'roll_no',
        'class',
        'section',
        'academic_year',
        'is_active',
    ];

    /* ======================
       RELATIONSHIPS
    ====================== */

    public function institute()
    {
        return $this->belongsTo(Institute::class, 'institute_id');
    }

    // ✅ Student belongs to Parent
    public function parent()
    {
        return $this->belongsTo(ParentUser::class, 'parent_id');
    }

    public function fee()
    {
        return $this->hasOne(StudentFee::class, 'student_id');
    }

    public function dues()
    {
        return $this->hasMany(StudentDue::class, 'student_id');
    }

    public function unpaidDues()
    {
        return $this->hasMany(StudentDue::class, 'student_id')
                    ->where('status', 'UNPAID');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'student_id');
    }

    /* ======================
       HELPERS
    ====================== */

    public function totalDueAmount()
    {
        return $this->unpaidDues()->sum('amount');
    }

    public function advanceAmount()
    {
        return $this->payments()
                    ->where('type', 'ADVANCE')
                    ->sum('amount');
    }
}
