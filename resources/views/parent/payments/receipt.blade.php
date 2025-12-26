@extends('parent.layout')

@section('content')
<div class="container p-4">

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="d-flex justify-content-between mb-3">
                <h4><strong>Payment Receipt</strong></h4>

                <button onclick="window.print()" class="btn btn-outline-primary">
                    <i class="fa fa-print"></i> Download / Print
                </button>
            </div>

            <hr>

            <div class="row mb-3">
                <div class="col-md-6">
                    <h6><strong>Student Details</strong></h6>
                    <p>
                        Name: {{ $payment->student->name }} <br>
                        Class: {{ $payment->student->class }} {{ $payment->student->section }} <br>
                        Academic Year: {{ $payment->student->academic_year }}
                    </p>
                </div>

                <div class="col-md-6 text-md-end">
                    <h6><strong>Receipt Info</strong></h6>
                    <p>
                        Receipt No: #{{ $payment->id }} <br>
                        Date: {{ $payment->created_at->format('d M Y, h:i A') }} <br>
                        Mode: {{ $payment->payment_mode }}
                    </p>
                </div>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Months Covered</th>
                        <th width="200">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $payment->months }}</td>
                        <td>₹ {{ number_format($payment->amount, 2) }}</td>
                    </tr>
                </tbody>
            </table>

            <h5 class="text-end mt-3">
                <strong>Total Paid: ₹ {{ number_format($payment->amount, 2) }}</strong>
            </h5>

            <div class="text-center mt-4 text-muted">
                --- Thank you for your payment ---
            </div>

            <div class="mt-4">
                <a href="{{ route('parent.dashboard') }}" class="btn btn-secondary">
                    Back to Dashboard
                </a>
            </div>

        </div>
    </div>

</div>
@endsection
