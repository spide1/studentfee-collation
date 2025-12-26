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

        // 1️⃣ CREATE PAYMENT RECORD
        $payment = StudentPayment::create([
            'student_id'   => $dues->first()->student_id,
            'parent_id'    => auth('parent')->id(),
            'amount'       => $totalAmount,
            'payment_mode' => 'ONLINE',
            'months'       => $dues->pluck('month')->implode(', '),
            'status'       => 'SUCCESS',
        ]);

        // 2️⃣ MARK ALL DUES AS PAID + LINK PAYMENT
        foreach ($dues as $due) {
            $due->update([
                'status'      => 'PAID',
                'payment_id'  => $payment->id,
            ]);
        }

        return back()->with('success', 'Payment successful');
    }

    public function receipt($paymentId)
    {
        $payment = \App\Models\StudentPayment::with(['student', 'dues'])
            ->findOrFail($paymentId);

        // security: only allow the parent who made the payment
        if ($payment->parent_id != auth('parent')->id()) {
            abort(403, 'Unauthorized');
        }

        return view('parent.payments.receipt', compact('payment'));
    }
}
