@extends('institute.layout')

@section('content')
    <div class="container">

        <div class="row mb-4">
            <div class="col-md-8">
                <h3>Register Student</h3>
            </div>
            <div class="col-md-4 text-end">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#excelUploadModal">
                    <i class="fa fa-file-excel"></i> Upload Excel
                </button>
            </div>
        </div>

        <!-- =====================
                    MANUAL STUDENT ENTRY
                ====================== -->
        <form method="POST" action="{{ route('institute.students.store') }}">
            @csrf

            <div class="card mb-4">
                <div class="card-body">

                    <div class="row">

                        <div class="col-md-4 mb-3">
                            <label>Student Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Parent Name</label>
                            <input type="text" name="parent_name" class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Parent Mobile</label>
                            <input type="text" name="mobile" class="form-control" maxlength="10" required>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Roll No</label>
                            <input type="text" name="roll_no" class="form-control">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Class</label>
                            <input type="text" name="class" class="form-control" placeholder="10 / 12 / BCA">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Section</label>
                            <input type="text" name="section" class="form-control" placeholder="A / B">
                        </div>

                        <div class="mb-3">
                            <label>Academic Year</label>
                            <input type="text" name="academic_year" class="form-control" placeholder="2025-2026"
                                required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Fee Start Month</label>
                            <select name="start_month" class="form-control" required>
                                @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                                    <option value="{{ $month }}">{{ $month }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Fee Start Year</label>
                            <select name="start_year" class="form-control" required>
                                @php $year = now()->year; @endphp
                                @for ($i = 0; $i <= 5; $i++)
                                    <option value="{{ $year + $i }}">{{ $year + $i }}</option>
                                @endfor
                            </select>
                        </div>


                        <div class="col-md-4 mb-3">
                            <label>Fee Type</label>
                            <select name="fee_type" class="form-control" required>
                                <option value="">Select</option>
                                <option value="MONTHLY">Monthly</option>
                                <option value="QUARTERLY">Quarterly</option>
                                <option value="ANNUAL">Annual</option>
                                <option value="ADVANCE">Full Advance</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Base Fee Amount</label>
                            <input type="number" name="base_fee" class="form-control" required>
                        </div>

                    </div>

                    <button class="btn btn-primary">
                        Save Student
                    </button>

                </div>
            </div>
        </form>

    </div>


    <!-- =====================
            EXCEL UPLOAD MODAL
        ===================== -->
    <div class="modal fade" id="excelUploadModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Upload Students (Excel)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form method="POST" action="{{ route('institute.students.import') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">

                        <!-- Academic Year -->
                        <div class="mb-3">
                            <label>Academic Year</label>
                            <select name="academic_year" class="form-control" required>
                                @php
                                    $startYear = now()->year;
                                @endphp
                                @for ($i = 0; $i < 5; $i++)
                                    <option value="{{ $startYear + $i }}-{{ $startYear + $i + 1 }}">
                                        {{ $startYear + $i }} - {{ $startYear + $i + 1 }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <!-- Fee Start Month -->
                        <div class="mb-3">
                            <label>Fee Start Month</label>
                            <select name="start_month" class="form-control" required>
                                @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                                    <option value="{{ $month }}">{{ $month }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Fee Start Year</label>
                            <select name="start_year" class="form-control" required>
                                @php
                                    $currentYear = now()->year;
                                @endphp

                                @for ($i = 0; $i <= 5; $i++)
                                    <option value="{{ $currentYear + $i }}">
                                        {{ $currentYear + $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>


                        <!-- Fee Plan -->
                        <div class="mb-3">
                            <label>Fee Plan Type</label>
                            <select name="fee_type" class="form-control" required>
                                <option value="">Select</option>
                                <option value="MONTHLY">Monthly</option>
                                <option value="QUARTERLY">Quarterly</option>
                                <option value="ANNUAL">Annual</option>
                                <option value="ADVANCE">Full Advance</option>
                            </select>
                        </div>

                        <!-- Excel File -->
                        <div class="mb-3">
                            <label>Select Excel File</label>
                            <input type="file" name="excel_file" class="form-control" accept=".xls,.xlsx" required>
                        </div>

                        <!-- Info -->
                        <div class="alert alert-info">
                            <strong>Excel Columns (Exact Order):</strong><br>
                            <small>
                                name | parent_name | mobile | roll_no | class | section | base_fee
                            </small>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button class="btn btn-success">
                            Upload & Process
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
