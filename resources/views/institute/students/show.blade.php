@extends('institute.layout')

@section('content')
<div class="container">

    <h3>Student Details</h3>

    {{-- ================= STUDENT INFO ================= --}}
    <div class="card mb-3">
        <div class="card-body">
            <strong>Name:</strong> {{ $student->name }} <br>
            <strong>Class:</strong> {{ $student->class }} {{ $student->section }} <br>
            <strong>Mobile:</strong> {{ $student->mobile }} <br>
            <strong>Academic Year:</strong> {{ $student->academic_year }}
        </div>
    </div>

    {{-- ================= FEE STRUCTURE ================= --}}
    <h5>Fee Structure</h5>
    <ul>
        <li>Monthly: ₹ {{ optional($student->fee)->monthly_fee }}</li>
        <li>Quarterly: ₹ {{ optional($student->fee)->quarterly_fee }}</li>
        <li>Annual: ₹ {{ optional($student->fee)->annual_fee }}</li>
    </ul>

    {{-- ================= FILTER BAR ================= --}}
    <h5 class="mt-4">Filter Dues</h5>

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
                @foreach($student->dues->pluck('year')->unique() as $y)
                    <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                        {{ $y }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <select name="status" class="form-control">
                <option value="">All Status</option>
                <option value="PAID" {{ request('status') == 'PAID' ? 'selected' : '' }}>Paid</option>
                <option value="UNPAID" {{ request('status') == 'UNPAID' ? 'selected' : '' }}>Unpaid</option>
            </select>
        </div>

        <div class="col-md-2">
            <button class="btn btn-primary w-100">
                Search
            </button>
        </div>

    </form>

    {{-- ================= DUES TABLE ================= --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Month</th>
                <th>Year</th>
                <th>Amount</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
        @forelse($dues as $due)
            <tr>
                <td>{{ $due->month }}</td>
                <td>{{ $due->year }}</td>
                <td>₹ {{ number_format($due->amount, 2) }}</td>

                <td>
                    @if($due->status === 'PAID')
                        <span class="badge bg-success">Paid</span>
                    @else
                        <span class="badge bg-danger">Unpaid</span>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center text-muted">
                    No dues found
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{-- ================= TOTAL ================= --}}
    <h5>
        Total Due (Filtered):
        <span class="text-danger">
            ₹ {{ number_format($totalDue, 2) }}
        </span>
    </h5>

    <a href="{{ route('institute.students.index') }}" class="btn btn-secondary mt-3">
        Back
    </a>

</div>
@endsection
