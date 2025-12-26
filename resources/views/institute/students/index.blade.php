@extends('institute.layout')

@section('content')
<div class="container">

    <h3 class="mb-3">Student List</h3>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif


    {{-- ================= FILTER FORM ================= --}}
    <form method="GET" class="row g-2 mb-3">

        <div class="col-md-3">
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   class="form-control"
                   placeholder="Search name / mobile">
        </div>

        <div class="col-md-2">
            <select name="class" class="form-control">
                <option value="">All Classes</option>
                @foreach($students->pluck('class')->unique() as $c)
                    <option value="{{ $c }}" {{ request('class') == $c ? 'selected' : '' }}>
                        {{ $c }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <select name="year" class="form-control">
                <option value="">All Academic Years</option>
                @foreach($students->pluck('academic_year')->unique() as $y)
                    <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                        {{ $y }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <select name="status" class="form-control">
                <option value="">All Status</option>
                <option value="Y" {{ request('status') == 'Y' ? 'selected' : '' }}>Active</option>
                <option value="N" {{ request('status') == 'N' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div class="col-md-2">
            <button class="btn btn-primary w-100">
                Filter
            </button>
        </div>

    </form>


    {{-- ================= TABLE ================= --}}
    <table class="table table-bordered" id="studentsTable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Parent Name</th>
                <th>Class</th>
                <th>Roll</th>
                <th>Mobile</th>
                <th>Academic Year</th>
                <th>Monthly Fee</th>
                <th>Quarterly Fee</th>
                <th>Annual Fee</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        @foreach($students as $student)
            <tr>
                <td>{{ $student->name }}</td>
                <td>{{ $student->parent_name }}</td>
                <td>{{ $student->class }} {{ $student->section }}</td>
                <td>{{ $student->roll_no }}</td>
                <td>{{ $student->mobile }}</td>
                <td>{{ $student->academic_year }}</td>

                <td>₹ {{ optional($student->fee)->monthly_fee }}</td>
                <td>₹ {{ optional($student->fee)->quarterly_fee }}</td>
                <td>₹ {{ optional($student->fee)->annual_fee }}</td>

                <td>
                    <a href="{{ route('institute.students.show', $student->id) }}"
                       class="btn btn-sm btn-primary">
                        View
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
$(document).ready(function () {
    $('#studentsTable').DataTable({
        pageLength: 25,
        ordering: true,
        searching: false,   // because we are using server filter
        responsive: true
    });
});
</script>
@endpush
