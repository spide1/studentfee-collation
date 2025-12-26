<?php

namespace App\Http\Controllers;

use App\Models\StudentDue;
use App\Models\StudentPayment;

use Illuminate\Http\Request;

class ParentPaymentController extends Controller
{

    public function paySelected(Request $request)
    {
        $request->validate([
            'dues' => 'required|array|min:1',
        ]);

        $dues = StudentDue::whereIn('id', $request->dues)
            ->where('status', 'UNPAID')
            ->get();

        if ($dues->isEmpty()) {
            return back()->withErrors(['error' => 'No unpaid dues selected']);
        }

        $totalAmount = $dues->sum('amount');

        foreach ($dues as $due) {
            $due->update(['status' => 'PAID']);
        }

        StudentPayment::create([
            'student_id' => $dues->first()->student_id,
            'parent_id'  => auth('parent')->id(),
            'amount'     => $totalAmount,
            'payment_mode' => 'ONLINE',
            'months'     => $dues->pluck('month')->implode(', '),
            'status'     => 'SUCCESS',
        ]);

        return back()->with('success', 'Payment successful');
    }
}
