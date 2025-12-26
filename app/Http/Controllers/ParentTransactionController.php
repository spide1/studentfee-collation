<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentPayment;

class ParentTransactionController extends Controller
{
    public function index(Request $request)
    {
        $parentId = auth('parent')->id();

        $query = StudentPayment::where('parent_id', $parentId)
            ->where('status', 'SUCCESS');

        // ✅ Filter by Month
        if ($request->month) {
            $query->where('months', 'LIKE', '%' . $request->month . '%');
        }

        // ✅ Filter by Year
        if ($request->year) {
            $query->whereYear('created_at', $request->year);
        }

        $transactions = $query
            ->latest()
            ->get();

        return view('parent.transactions.index', compact('transactions'));
    }
}
