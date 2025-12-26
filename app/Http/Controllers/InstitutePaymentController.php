<?php

namespace App\Http\Controllers;

use App\Models\StudentPayment;

class InstitutePaymentController extends Controller
{
    public function transactions()
{
    $instituteId = auth('institute')->id();

    $query = StudentPayment::with('student')
        ->whereHas('student', function ($q) use ($instituteId) {
            $q->where('institute_id', $instituteId);
        });

    // 🔍 Search student name / mobile
    if (request('keyword')) {
        $query->whereHas('student', function ($q) {
            $q->where('name', 'like', '%' . request('keyword') . '%')
              ->orWhere('mobile', 'like', '%' . request('keyword') . '%');
        });
    }

    // 🎓 Class filter
    if (request('class')) {
        $query->whereHas('student', function ($q) {
            $q->where('class', request('class'));
        });
    }

    // 🏫 Institute (optional if multi-branch later)
    if (request('institute')) {
        $query->whereHas('student', function ($q) {
            $q->where('institute_id', request('institute'));
        });
    }

    // 📅 Academic year (from created_at or dues year)
    if (request('year')) {
        $query->whereYear('created_at', request('year'));
    }

    // 📆 Month (from months column)
    if (request('month')) {
        $query->where('months', 'like', '%' . request('month') . '%');
    }

    $transactions = $query->latest()->paginate(15);

    return view('institute.payments.transactions', compact('transactions'));
}



}

