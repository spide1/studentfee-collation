@extends('institute.layout')

@section('content')
<div class="container-fluid p-4">

    <h4 class="mb-3">Payment Transactions</h4>

    {{-- ================= FILTER BAR ================= --}}
   <form method="GET" class="row g-3 mb-3">

    <div class="col-md-3">
        <label>Search keyword</label>
        <input type="text" name="keyword" value="{{ request('keyword') }}"
               class="form-control" placeholder="Student / Mobile">
    </div>

    <div class="col-md-2">
        <label>Class</label>
        <input type="text" name="class" value="{{ request('class') }}"
               class="form-control">
    </div>

    <div class="col-md-2">
        <label>Month</label>
        <select name="month" class="form-control">
            <option value="">All</option>
            @foreach(['January','February','March','April','May','June','July','August','September','October','November','December'] as $m)
                <option value="{{ $m }}" {{ request('month')==$m?'selected':'' }}>{{ $m }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-2">
        <label>Year</label>
        <select name="year" class="form-control">
            <option value="">All</option>
            @for($y = now()->year-3; $y <= now()->year+1; $y++)
                <option value="{{ $y }}" {{ request('year')==$y?'selected':'' }}>{{ $y }}</option>
            @endfor
        </select>
    </div>

    <div class="col-md-2 d-flex align-items-end">
        <button class="btn btn-primary w-100">
            <i class="fa fa-search"></i> Search
        </button>
    </div>

</form>


    {{-- ================= ACTION BAR ================= --}}
    {{-- <div class="d-flex justify-content-end mb-2">
        <button class="btn btn-outline-secondary me-2">
            <i class="fa fa-download"></i>
        </button>

        <button class="btn btn-outline-primary me-2">
            Export CSV
        </button>

        <button class="btn btn-outline-danger">
            Export PDF
        </button>
    </div> --}}

    {{-- ================= TABLE ================= --}}
    <div class="card">
        <div class="card-body table-responsive">

            <table class="table table-hover align-middle" id="transactionsTable">
                <thead class="table-light">
                    <tr>
                        <th>Student Name</th>
                        <th>Institute Name</th>
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
                        <td>{{ $txn->student->institute->name ?? '-' }}</td>
                        <td>{{ $txn->student->class }}</td>

                        <td>{{ $txn->months }}</td>

                        <td>₹ {{ number_format($txn->amount,2) }}</td>

                        <td>{{ $txn->created_at->format('d M Y') }}</td>

                        <td>
                            <span class="badge bg-success">{{ $txn->status }}</span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            No transactions found
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
$(document).ready(function () {

    $('#transactionsTable').DataTable({
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100],
        ordering: true,
        searching: true,
        dom: 'Bfrtip',
        buttons: [
            'copy',
            'csv',
            'pdf',
            'print'
        ]
    });

});
</script>
@endpush
