    @extends('institute.layout')

    @section('content')
    <div class="container">

        <h3>Student List</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

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
                        {{-- VIEW BUTTON --}}
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
                pageLength: 50,
                lengthMenu: [5, 10, 25, 50],
                ordering: true,
                searching: true,
                responsive: true
            });
        });
    </script>
    @endpush
