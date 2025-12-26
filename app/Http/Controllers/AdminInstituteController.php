<?php

namespace App\Http\Controllers;

use App\Models\Institute;
use Illuminate\Http\Request;

class AdminInstituteController extends Controller
{
    public function index()
    {
        $institutes = Institute::orderBy('created_at', 'desc')->get();
        return view('admin.dashboard', compact('institutes'));
    }


   // 🔁 APPROVE / UNAPPROVE
    public function toggle($id)
    {
        $institute = Institute::findOrFail($id);

        $institute->is_active = $institute->is_active === 'Y' ? 'N' : 'Y';
        $institute->save();

        return back()->with('success', 'Institute status updated successfully');
    }
}
