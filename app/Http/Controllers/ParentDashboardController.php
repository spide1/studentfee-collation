<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Student;

class ParentDashboardController extends Controller
{
    /**
     * Parent Dashboard
     */
    public function index()
    {
        $parent = Auth::guard('parent')->user();

        // All children of this parent with fees & dues
        $students = Student::with(['fee', 'dues'])
            ->where('parent_id', $parent->id)
            ->get();

        $totalDue = $students
            ->flatMap(fn ($student) => $student->unpaidDues)
            ->sum('amount');

        return view('parent.dashboard', compact(
            'parent',
            'students',
            'totalDue'
        ));
    }
}
