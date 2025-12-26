@extends('parent.layout')

@section('content')
<div class="container-fluid p-4">

    <h3 class="mb-3">
        Welcome, {{ $parent->name }}
    </h3>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-bg-danger">
                <div class="card-body">
                    <h5>Total Due</h5>
                    <h3>₹ {{ $totalDue }}</h3>
                </div>
            </div>
        </div>
    </div>

    <h5 class="mb-3">My Children</h5>

    <table class="table table-bordered" id="childrenTable">
        <thead>
            <tr>
                <th>Student</th>
                <th>Class</th>
                <th>Academic Year</th>
                <th>Monthly Fee</th>
                <th>Total Due</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($students as $student)
            <tr>
                <td>{{ $student->name }}</td>
                <td>{{ $student->class }} {{ $student->section }}</td>
                <td>{{ $student->academic_year }}</td>
                <td>₹ {{ optional($student->fee)->monthly_fee }}</td>
                <td class="text-danger">
                    ₹ {{ $student->unpaidDues->sum('amount') }}
                </td>
                <td>
                    <a href="{{ route('parent.student.show', $student->id) }}"
                       class="btn btn-sm btn-primary">
                        View & Pay
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
@endsection

@push('scripts')
<script>
$(function () {
    $('#childrenTable').DataTable();
});
</script>
@endpush
