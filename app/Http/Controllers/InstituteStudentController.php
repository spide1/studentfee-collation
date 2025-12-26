<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentFee;
use App\Models\StudentDue;
use App\Models\ParentUser;
use App\Services\FeeCalculator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentsImport;

class InstituteStudentController extends Controller
{
    /* ======================
       STUDENT LIST
    ====================== */
   public function index(Request $request)
{
    $query = Student::with('fee')
        ->where('institute_id', auth('institute')->id());

    if ($request->search) {
        $query->where(function ($q) use ($request) {
            $q->where('name', 'like', "%{$request->search}%")
              ->orWhere('mobile', 'like', "%{$request->search}%");
        });
    }

    if ($request->class) {
        $query->where('class', $request->class);
    }

    if ($request->year) {
        $query->where('academic_year', $request->year);
    }

    if ($request->status) {
        $query->where('is_active', $request->status);
    }

    $students = $query->get();

    return view('institute.students.index', compact('students'));
}




    /* ======================
       CREATE FORM
    ====================== */
    public function create()
    {
        return view('institute.students.create');
    }

    /* ======================
       MANUAL STUDENT SAVE
    ====================== */


    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'parent_name'   => 'required',
            'mobile'        => 'required|digits:10',
            'academic_year' => 'required',
            'fee_type'      => 'required',
            'base_fee'      => 'required|numeric',
            'start_month'   => 'required',
            'start_year'    => 'required|integer',
        ]);

        /** ✅ CREATE / GET PARENT */
        $parent = ParentUser::firstOrCreate(
            ['mobile' => $request->mobile],
            [
                'name'      => $request->parent_name,
                'is_active' => 'Y',
            ]
        );

        /** ✅ CREATE STUDENT */
        $student = Student::create([
            'institute_id'  => auth('institute')->id(),
            'parent_id'     => $parent->id,
            'name'          => $request->name,
            'parent_name'   => $request->parent_name,
            'mobile'        => $request->mobile,
            'roll_no'       => $request->roll_no,
            'class'         => $request->class,
            'section'       => $request->section,
            'academic_year' => $request->academic_year,
            'is_active'     => 'Y',
        ]);

        /** ✅ CALCULATE FEES */
        $fee = FeeCalculator::calculate(
            $request->fee_type,
            $request->base_fee
        );

        /** ✅ SAVE FEES */
        StudentFee::create([
            'student_id'    => $student->id,
            'monthly_fee'   => $fee['monthly_fee'],
            'quarterly_fee' => $fee['quarterly_fee'],
            'annual_fee'    => $fee['annual_fee'],
            'is_active'     => 'Y',
        ]);

        /** ✅ GENERATE DUES */
        $this->generateDues(
    $student,
    $request->fee_type,
    $request->base_fee,
    $request->academic_year
);


        return redirect()->back()->with('success', 'Student & Parent created successfully');
    }


    /* ======================
       EXCEL IMPORT
    ====================== */
    public function import(Request $request)
    {
        $request->validate([
            'excel_file'    => 'required|mimes:xls,xlsx',
            'fee_type'      => 'required',
            'academic_year' => 'required',
            'start_month'   => 'required',
            'start_year'    => 'required|integer',
        ]);

        Excel::import(
            new StudentsImport(
                auth('institute')->id(),
                $request->fee_type,
                $request->academic_year,
                $request->start_month,
                $request->start_year
            ),
            $request->file('excel_file')
        );

        return redirect()
            ->route('institute.students.index')
            ->with('success', 'Students imported successfully');
    }

   public function show(Request $request, $id)
{
    $student = Student::with(['fee', 'dues'])->findOrFail($id);

    $query = $student->dues()->orderBy('year')->orderBy('id');

    // Apply filters
    if ($request->filled('month')) {
        $query->where('month', $request->month);
    }

    if ($request->filled('year')) {
        $query->where('year', $request->year);
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $dues = $query->get();

    $totalDue = $dues->where('status', 'UNPAID')->sum('amount');

    return view('institute.students.show', compact(
        'student',
        'dues',
        'totalDue'
    ));
}




    /* ======================
       GENERATE MONTHLY DUES
    ====================== */
  private function generateDues($student, $feeType, $baseFee, $academicYear)
{
    [$startYear, $endYear] = explode('-', $academicYear);

    $months = [
        'April','May','June',
        'July','August','September',
        'October','November','December',
        'January','February','March'
    ];

    // MONTHLY PLAN
    if ($feeType === 'MONTHLY') {

        foreach ($months as $month) {
            $year = ($month == 'January' || $month == 'February' || $month == 'March')
                ? $endYear
                : $startYear;

            StudentDue::create([
                'student_id' => $student->id,
                'month'      => $month,
                'year'       => $year,
                'amount'     => $baseFee,
                'status'     => 'UNPAID',
            ]);
        }
    }

    // QUARTERLY PLAN (4 dues only)
    if ($feeType === 'QUARTERLY') {

        $quarters = [
            ['April','May','June'],
            ['July','August','September'],
            ['October','November','December'],
            ['January','February','March'],
        ];

        foreach ($quarters as $group) {

            $year = (in_array('January',$group)) ? $endYear : $startYear;

            StudentDue::create([
                'student_id' => $student->id,
                'month'      => implode('-', $group),  // "April-May-June"
                'year'       => $year,
                'amount'     => $baseFee,              // only ₹1200 per quarter
                'status'     => 'UNPAID',
            ]);
        }
    }

    // ANNUAL PLAN
    if ($feeType === 'ANNUAL') {

        StudentDue::create([
            'student_id' => $student->id,
            'month'      => "APRIL-MARCH",
            'year'       => $startYear,
            'amount'     => $baseFee,
            'status'     => 'UNPAID',
        ]);
    }

    // FULL ADVANCE
    if ($feeType === 'ADVANCE') {

        StudentDue::create([
            'student_id' => $student->id,
            'month'      => "ADVANCE",
            'year'       => $startYear,
            'amount'     => $baseFee,
            'status'     => 'UNPAID',
        ]);
    }
}

}
