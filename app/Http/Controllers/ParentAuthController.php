<?php

namespace App\Http\Controllers;

use App\Models\ParentUser;
use App\Models\Otp;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ParentAuthController extends Controller
{
    /* ======================
       LOGIN PAGE
    ====================== */
    public function loginView()
    {
        return view('parent.login');
    }

    /* ======================
       SEND OTP
    ====================== */
    public function sendOtp(Request $request)
    {
        $request->validate([
            'mobile' => 'required|digits:10',
        ]);

        $mobile = $request->mobile;

        // 🔥 Create parent if not exists
        ParentUser::firstOrCreate(
            ['mobile' => $mobile],
            ['name' => 'Parent', 'is_active' => 'Y']
        );

        // 🔥 Generate OTP
        $otp = rand(100000, 999999);

        // 🔥 Delete old OTPs
        Otp::where('identifier', $mobile)->delete();

        // 🔥 Save OTP
        Otp::create([
            'identifier' => $mobile,
            'otp'        => $otp,
            'expires_at' => Carbon::now()->addMinutes(5),
        ]);

        // ⚠️ TEMPORARY: log OTP (for testing)
        \Log::info("Parent OTP for {$mobile} is {$otp}");

        return response()->json([
            'status'   => true,
            'redirect' => route('parent.otp', ['mobile' => $mobile]),
        ]);
    }

    public function resendOtp(Request $request)
    {
        $request->validate([
            'mobile' => 'required|digits:10',
        ]);

        $mobile = $request->mobile;

        // ✅ Parent must exist
        $parent = ParentUser::where('mobile', $mobile)->first();
        if (!$parent) {
            return response()->json([
                'status' => false,
                'message' => 'Mobile number not registered',
            ]);
        }

        // 🔥 Generate new OTP
        $otp = rand(100000, 999999);

        // 🔥 Delete old OTPs
        Otp::where('identifier', $mobile)->delete();

        // 🔥 Save new OTP
        Otp::create([
            'identifier' => $mobile,
            'otp'        => $otp,
            'expires_at' => Carbon::now()->addMinutes(5),
        ]);

        // ⚠️ TEMP: log OTP (for testing)
        \Log::info("Resent Parent OTP for {$mobile}: {$otp}");

        return response()->json([
            'status' => true,
            'message' => 'OTP resent successfully',
        ]);
    }

    /* ======================
       OTP PAGE
    ====================== */
    public function otpView(Request $request)
    {
        return view('parent.otp', [
            'mobile' => $request->mobile
        ]);
    }

    /* ======================
       VERIFY OTP
    ====================== */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'mobile' => 'required|digits:10',
            'otp'    => 'required|digits:6',
        ]);

        $otpRow = Otp::where('identifier', $request->mobile)
            ->where('otp', $request->otp)
            ->where('expires_at', '>=', now())
            ->first();

        if (!$otpRow) {
            return response()->json([
                'status'  => false,
                'message' => 'Invalid or expired OTP',
            ]);
        }

        // 🔥 Login parent
        $parent = ParentUser::where('mobile', $request->mobile)->first();

        Auth::guard('parent')->login($parent);

        // 🔥 Delete OTP after success
        $otpRow->delete();

        return response()->json([
            'status'   => true,
            'redirect' => route('parent.dashboard'),
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('parent')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('parent.login');
    }
}
