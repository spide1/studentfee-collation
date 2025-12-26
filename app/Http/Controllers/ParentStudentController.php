<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParentStudentController extends Controller
{
    public function show($id)
    {
        $student = Student::with('dues')->findOrFail($id);

        // ---- GROUP MONTHS BY QUARTER ----
        $dues = $student->dues()
            ->orderBy('year')
            ->orderByRaw("FIELD(month,
            'April','May','June',
            'July','August','September',
            'October','November','December',
            'January','February','March'
        )")
            ->get()
            ->groupBy(function ($due) {
                return ceil((date('n', strtotime($due->month . ' 1'))) / 3);
            });

        return view('parent.student.show', compact('student', 'dues'));
    }
}
