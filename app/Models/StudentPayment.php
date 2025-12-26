<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentPayment extends Model
{
    protected $fillable = [
        'student_id',
        'parent_id',
        'amount',
        'payment_mode',
        'months',
        'status',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function dues()
    {
        return $this->hasMany(StudentDue::class, 'payment_id');
    }

    public function parent()
    {
        return $this->belongsTo(ParentUser::class, 'parent_id');
    }
}
