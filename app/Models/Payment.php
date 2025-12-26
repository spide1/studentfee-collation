<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'student_id',
        'amount',
        'type',        // DUE | ADVANCE
        'mode',        // ONLINE | CASH | UPI
        'remarks',
        'is_active',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    /* ======================
       RELATIONSHIPS
    ====================== */

    // Payment belongs to Student
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
