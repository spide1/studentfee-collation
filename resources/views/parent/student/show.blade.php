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

        <input type="hidden" name="student_id" value="{{ $student->id }}">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="50">
                        <input type="checkbox" id="selectAll">
                    </th>
                    <th>Month</th>
                    <th>Year</th>
                    <th>Amount</th>
                    <th>Status / Receipt</th>
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
                    <td>₹ {{ number_format($due->amount,2) }}</td>

                    <td>
                        @if($due->status === 'PAID')
                            <span class="badge bg-success">Paid</span>

                            @if($due->payment)
                                <a href="{{ route('parent.payment.receipt', $due->payment->id) }}"
                                   class="btn btn-sm btn-outline-primary ms-2">
                                    Download Receipt
                                </a>
                            @endif

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
            <span class="text-primary">
                ₹ <span id="selectedAmount">0</span>
            </span>
        </h5>

        <!-- ACTIONS -->
        <div class="mt-3">
            <button type="button" class="btn btn-warning" id="paySelectedBtn" disabled>
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


<!-- PAYMENT CONFIRM MODAL -->
<div class="modal fade" id="confirmPaymentModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Confirm Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p id="confirmText">
                    Are you sure you want to proceed with this payment?
                </p>
            </div>

            <div class="modal-footer">
                <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                    Cancel
                </button>

                <button type="button"
                        class="btn btn-primary"
                        id="confirmPayBtn">
                    Confirm & Pay
                </button>
            </div>

        </div>
    </div>
</div>
@endsection


@push('scripts')
<script>
const checkboxes = document.querySelectorAll('.due-checkbox');
const selectAll = document.getElementById('selectAll');
const selectedAmountEl = document.getElementById('selectedAmount');
const paySelectedBtn = document.getElementById('paySelectedBtn');

let isFullPayment = false;

function calculateTotal() {
    let total = 0;
    checkboxes.forEach(cb => cb.checked && (total += parseFloat(cb.dataset.amount)));
    selectedAmountEl.innerText = total.toFixed(2);
    paySelectedBtn.disabled = total === 0;
}

checkboxes.forEach(cb => cb.addEventListener('change', calculateTotal));

selectAll.addEventListener('change', function () {
    checkboxes.forEach(cb => cb.checked = this.checked);
    calculateTotal();
});

const paymentForm = document.getElementById('paymentForm');
const confirmModal = new bootstrap.Modal(document.getElementById('confirmPaymentModal'));
const confirmText = document.getElementById('confirmText');

// PAY SELECTED
paySelectedBtn.addEventListener('click', function (e) {
    e.preventDefault();
    isFullPayment = false;

    confirmText.innerHTML =
        `You are about to pay <strong>₹ ${selectedAmountEl.innerText}</strong>.<br>
         Do you want to continue?`;

    confirmModal.show();
});

// PAY FULL
document.getElementById('payFullBtn').addEventListener('click', function (e) {
    e.preventDefault();
    isFullPayment = true;

    checkboxes.forEach(cb => cb.checked = true);
    selectAll.checked = true;
    calculateTotal();

    confirmText.innerHTML =
        `You are about to pay the <strong>full outstanding amount</strong>.<br>
         Total: <strong>₹ ${selectedAmountEl.innerText}</strong>.<br>
         Proceed?`;

    confirmModal.show();
});

// FINAL CONFIRM
document.getElementById('confirmPayBtn').addEventListener('click', function () {
    confirmModal.hide();
    paymentForm.submit();
});
</script>
@endpush
