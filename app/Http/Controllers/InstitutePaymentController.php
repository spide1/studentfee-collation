<?php

namespace App\Http\Controllers;

use App\Models\StudentPayment;

class InstitutePaymentController extends Controller
{
    public function transactions()
    {
        $transactions = StudentPayment::with('student')
            ->latest()
            ->get();

        return view('institute.payments.transactions', compact('transactions'));
    }


}

