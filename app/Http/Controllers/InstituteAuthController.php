<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Institute;

class InstituteAuthController extends Controller
{
    /* =========================
       REGISTER
    ========================= */

    public function showRegister()
    {
        return view('auth.institute-register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:institutes,email',
            'password' => 'required|min:6|confirmed',
        ]);

        Institute::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
            'is_active' => 'N', // ⛔ Pending admin approval
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Registration successful. Await admin approval.',
            'redirect'=> route('institute.login')
        ]);
    }

    /* =========================
       LOGIN
    ========================= */

    public function showLogin()
    {
        return view('auth.institute-login');
    }

  public function login(Request $request)
{
    $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);

    $institute = Institute::where('email', $request->email)->first();

    // ❌ Invalid credentials
    if (!$institute || !Hash::check($request->password, $institute->password)) {
        return response()->json([
            'status'  => false,
            'message' => 'Invalid email or password'
        ], 401);
    }

    // 🚫 ADMIN NOT APPROVED
    if ($institute->is_active !== 'Y') {
        return response()->json([
            'status'  => false,
            'message' => 'Your institute is not approved yet. Please wait for admin approval.'
        ], 403);
    }

    // ✅ LOGIN
    Auth::guard('institute')->login($institute);

    return response()->json([
        'status'   => true,
        'redirect' => route('institute.dashboard')
    ]);
}


    /* =========================
       LOGOUT
    ========================= */

    public function logout()
    {
        Auth::logout();
        return redirect()->route('institute.login');
    }
}
