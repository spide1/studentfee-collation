<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParentStudentController extends Controller
{
   public function show(Request $request, $id)
{
    $student = Student::with('dues', 'fee')->findOrFail($id);

    if ($request->month || $request->year) {
        $student->setRelation(
            'dues',
            $student->dues->filter(function ($due) use ($request) {
                return
                    (!$request->month || $due->month === $request->month) &&
                    (!$request->year || $due->year == $request->year);
            })
        );
    }

    return view('parent.student.show', compact('student'));
}

}
