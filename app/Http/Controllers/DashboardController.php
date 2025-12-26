<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    $instituteId = auth('institute')->id();

    // Total fee generated for all students
    $netPayable = \App\Models\StudentDue::whereHas('student', function ($q) use ($instituteId) {
        $q->where('institute_id', $instituteId);
    })->sum('amount');

    // Total paid
    $paidAmount = \App\Models\StudentDue::whereHas('student', function ($q) use ($instituteId) {
        $q->where('institute_id', $instituteId);
    })->where('status', 'PAID')
      ->sum('amount');

    // Unpaid amount
    $unpaidAmount = \App\Models\StudentDue::whereHas('student', function ($q) use ($instituteId) {
        $q->where('institute_id', $instituteId);
    })->where('status', 'UNPAID')
      ->sum('amount');

    return view('institute.dashboard', compact(
        'netPayable',
        'paidAmount',
        'unpaidAmount'
    ));
}

}
