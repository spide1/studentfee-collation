<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminAuthController extends Controller
{
    /**
     * Show admin login page
     */
    public function showLogin()
    {
        return view('auth.admin-login');
    }

    /**
     * Handle admin login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        $admin = Admin::where('email', $request->email)
            ->where('is_active', 'Y')
            ->first();

        if (! $admin || ! Hash::check($request->password, $admin->password)) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'Invalid email or password',
                ]);
        }

        // ✅ Login with ADMIN guard
        Auth::guard('admin')->login($admin);

        // ✅ Regenerate session (important security step)
        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');
    }

    /**
     * Logout admin
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
