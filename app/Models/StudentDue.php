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
        'payment_id',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function payment()
    {
        return $this->belongsTo(StudentPayment::class, 'payment_id');
    }
}
