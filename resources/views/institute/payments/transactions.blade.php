@extends('institute.layout')

@section('content')
<div class="container-fluid p-4">

    <h4>Payment Transactions</h4>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Student</th>
                <th>Class</th>
                <th>Months Paid</th>
                <th>Amount</th>
                <th>Payment Date</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
        @forelse($transactions as $txn)
            <tr>
                <td>{{ $txn->student->name }}</td>
                <td>{{ $txn->student->class }} {{ $txn->student->section }}</td>
                <td>{{ $txn->months }}</td>
                <td>₹ {{ number_format($txn->amount, 2) }}</td>
                <td>{{ $txn->created_at->format('d M Y, h:i A') }}</td>
                <td>
                    <span class="badge bg-success">{{ $txn->status }}</span>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">No transactions found</td>
            </tr>
        @endforelse
        </tbody>
    </table>

</div>
@endsection
