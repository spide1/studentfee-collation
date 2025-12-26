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
    public function index()
    {
        $currentMonth = now()->format('F');   // April
        $currentYear  = now()->year;           // 2025

        $students = Student::with([
            'fee',
            'dues' => function ($q) use ($currentMonth, $currentYear) {
                $q->where('month', $currentMonth)
                    ->where('year', $currentYear);
            }
        ])
            ->where('institute_id', auth('institute')->id())
            ->get();

        return view(
            'institute.students.index',
            compact('students', 'currentMonth', 'currentYear')
        );
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
        $this->generateMonthlyDues(
            $student,
            $fee['monthly_fee'],
            $request->start_month,
            $request->start_year
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

        // Selected month/year (default = first due)
        $startMonth = $request->get('month');
        $startYear  = $request->get('year');

        if ($startMonth && $startYear) {
            $student->dues = $student->dues
                ->filter(function ($due) use ($startMonth, $startYear) {
                    return strtotime($due->month . ' ' . $due->year) >= strtotime($startMonth . ' ' . $startYear);
                });
        }

        return view('institute.students.show', compact(
            'student',
            'startMonth',
            'startYear'
        ));
    }



    /* ======================
       GENERATE MONTHLY DUES
    ====================== */
    private function generateMonthlyDues($student, $monthlyFee, $startMonth, $startYear)
    {
        if (!$monthlyFee || $monthlyFee <= 0) {
            return;
        }

        $months = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ];

        $startIndex = array_search($startMonth, $months);

        for ($i = 0; $i < 12; $i++) {

            $monthIndex = ($startIndex + $i) % 12;
            $year = $startYear + intdiv($startIndex + $i, 12);

            StudentDue::create([
                'student_id' => $student->id,
                'month'      => $months[$monthIndex],
                'year'       => $year,
                'amount'     => $monthlyFee,
                'status'     => 'UNPAID',
                'is_active'  => 'Y',
            ]);
        }
    }
}
