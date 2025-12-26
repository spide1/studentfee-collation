@extends('institute.layout')

@section('content')
    <div class="container">

        <h3>Student Details</h3>

        <div class="card mb-3">
            <div class="card-body">
                <strong>Name:</strong> {{ $student->name }} <br>
                <strong>Class:</strong> {{ $student->class }} {{ $student->section }} <br>
                <strong>Mobile:</strong> {{ $student->mobile }} <br>
                <strong>Academic Year:</strong> {{ $student->academic_year }}
            </div>
        </div>

        <h5>Fee Structure</h5>
        <ul>
            <li>Monthly: ₹ {{ optional($student->fee)->monthly_fee }}</li>
            <li>Quarterly: ₹ {{ optional($student->fee)->quarterly_fee }}</li>
            <li>Annual: ₹ {{ optional($student->fee)->annual_fee }}</li>
        </ul>

        <h5 class="mt-4">Month-wise Dues</h5>

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
                @forelse($student->dues as $due)
                    <tr>
                        <td>{{ $due->month }}</td>
                        <td>{{ $due->year }}</td>
                        <td>₹ {{ $due->amount }}</td>
                        <td>
                            @if ($due->status === 'PAID')
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


        <h5>Total Due:
            <span class="text-danger">
                ₹ {{ $student->unpaidDues()->sum('amount') }}
            </span>
        </h5>

        {{-- <h5>
    Total Due:
    <span class="text-danger">
        ₹ {{ $student->dues->where('status','UNPAID')->sum('amount') }}
    </span>
</h5> --}}


        <a href="{{ route('institute.students.index') }}" class="btn btn-secondary mt-3">
            Back
        </a>

    </div>
@endsection
