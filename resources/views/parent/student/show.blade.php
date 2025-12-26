@extends('parent.layout')

@section('content')
<div class="container-fluid p-4">

    <h4>{{ $student->name }} – Fee Details</h4>

    <!-- STUDENT INFO -->
    <div class="card mb-3">
        <div class="card-body">
            <strong>Class:</strong> {{ $student->class }} {{ $student->section }} <br>
            <strong>Academic Year:</strong> {{ $student->academic_year }} <br>
            <strong>Monthly Fee:</strong> ₹ {{ optional($student->fee)->monthly_fee }}
        </div>
    </div>

    <!-- DUES TABLE -->
    <form method="POST" action="{{ route('parent.pay.selected') }}" id="paymentForm">
        @csrf

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="50">
                        <input type="checkbox" id="selectAll">
                    </th>
                    <th>Month</th>
                    <th>Year</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
            @foreach($student->dues as $due)
                <tr>
                    <td>
                        @if($due->status === 'UNPAID')
                            <input type="checkbox"
                                   class="due-checkbox"
                                   name="dues[]"
                                   value="{{ $due->id }}"
                                   data-amount="{{ $due->amount }}">
                        @endif
                    </td>

                    <td>{{ $due->month }}</td>
                    <td>{{ $due->year }}</td>
                    <td>₹ {{ number_format($due->amount, 2) }}</td>

                    <td>
                        @if($due->status === 'PAID')
                            <span class="badge bg-success">Paid</span>
                        @else
                            <span class="badge bg-danger">Due</span>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- TOTAL -->
        <h5 class="mt-3">
            Selected Amount:
            <span class="text-primary">₹ <span id="selectedAmount">0</span></span>
        </h5>

        <!-- ACTIONS -->
        <div class="mt-3">
            <button type="submit" class="btn btn-warning" id="paySelectedBtn" disabled>
                Pay Selected
            </button>

            <button type="button" class="btn btn-success" id="payFullBtn">
                Pay Full Amount (₹ {{ $student->totalDueAmount() }})
            </button>

            <a href="{{ route('parent.dashboard') }}" class="btn btn-secondary">
                Back
            </a>
        </div>

    </form>
</div>
@endsection

@push('scripts')
<script>
    const checkboxes = document.querySelectorAll('.due-checkbox');
    const selectAll = document.getElementById('selectAll');
    const selectedAmountEl = document.getElementById('selectedAmount');
    const paySelectedBtn = document.getElementById('paySelectedBtn');

    function calculateTotal() {
        let total = 0;
        checkboxes.forEach(cb => {
            if (cb.checked) {
                total += parseFloat(cb.dataset.amount);
            }
        });

        selectedAmountEl.innerText = total.toFixed(2);
        paySelectedBtn.disabled = total === 0;
    }

    // Individual checkbox change
    checkboxes.forEach(cb => {
        cb.addEventListener('change', calculateTotal);
    });

    // Select all
    selectAll.addEventListener('change', function () {
        checkboxes.forEach(cb => cb.checked = this.checked);
        calculateTotal();
    });

    // PAY FULL → auto select all
    document.getElementById('payFullBtn').addEventListener('click', function () {
        checkboxes.forEach(cb => cb.checked = true);
        selectAll.checked = true;
        calculateTotal();
        document.getElementById('paymentForm').submit();
    });
</script>
@endpush
