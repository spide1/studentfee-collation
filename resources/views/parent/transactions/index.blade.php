@extends('parent.layout')

@section('content')
<div class="container-fluid p-4">

    <h4>Payment Transactions</h4>

    <!-- FILTER -->
    <form method="GET" class="row g-2 mb-3">

        <div class="col-md-3">
            <select name="month" class="form-control">
                <option value="">All Months</option>
                @foreach([
                    'January','February','March','April','May','June',
                    'July','August','September','October','November','December'
                ] as $m)
                    <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                        {{ $m }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <select name="year" class="form-control">
                <option value="">All Years</option>
                @for($y = now()->year; $y >= now()->year - 5; $y--)
                    <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                        {{ $y }}
                    </option>
                @endfor
            </select>
        </div>

        <div class="col-md-2">
            <button class="btn btn-primary">
                Filter
            </button>
        </div>
    </form>

    <!-- TABLE -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Student</th>
                <th>Paid Months</th>
                <th>Amount</th>
                <th>Paid On</th>
            </tr>
        </thead>
        <tbody>
        @forelse($transactions as $trx)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ optional($trx->student)->name }}</td>
                <td>{{ $trx->months }}</td>
                <td>₹ {{ number_format($trx->amount, 2) }}</td>
                <td>{{ $trx->created_at->format('d M Y, h:i A') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center text-muted">
                    No transactions found
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

</div>
@endsection
