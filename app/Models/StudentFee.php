<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentFee extends Model
{
    protected $table = 'student_fees';

    protected $fillable = [
        'student_id',
        'monthly_fee',
        'quarterly_fee',
        'annual_fee',
        'is_active',
    ];

    protected $casts = [
        'monthly_fee'   => 'decimal:2',
        'quarterly_fee' => 'decimal:2',
        'annual_fee'    => 'decimal:2',
    ];

    /* ======================
       RELATIONSHIPS
    ====================== */

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
