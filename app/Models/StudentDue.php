<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentDue extends Model
{
    protected $table = 'student_dues';

    protected $fillable = [
        'student_id',
        'month',
        'year',
        'amount',
        'status',
        'is_active',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
