<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class StudentAuthController extends Controller
{
    /**
     * Login page
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Signup page (prefilled)
     */
    public function showSignup(Request $request)
    {
        return view('auth.signup', [
            'identifier' => $request->identifier ?? null
        ]);
    }

    /**
     * SEND OTP (LOGIN OR REDIRECT TO SIGNUP)
     */
   public function sendOtp(Request $request)
{
    $request->validate([
        'identifier' => 'required'
    ]);

    $identifier = trim($request->identifier);

    $student = Student::where('email', $identifier)
        ->orWhere('mobile', $identifier)
        ->first();

    // ❌ Not registered → signup page
    if (!$student) {
        return response()->json([
            'status'   => false,
            'redirect' => route('student.signup', [
                'identifier' => $identifier
            ])
        ]);
    }

    // ✅ Registered → send OTP
    $this->generateAndSendOtp($identifier, $student->id);

    return response()->json([
        'status'   => true,
        'message' => 'OTP sent successfully',
        'redirect'=> route('student.otp', [
            'identifier' => $identifier
        ])
    ]);
}


    /**
     * REGISTER + SEND OTP
     */
   public function register(Request $request)
{
    $request->validate([
        'email'  => 'nullable|email|unique:students,email',
        'mobile' => 'nullable|digits:10|unique:students,mobile',
    ]);

    if (!$request->email && !$request->mobile) {
        return response()->json([
            'status' => false,
            'message' => 'Email or mobile is required'
        ]);
    }

    $student = Student::create([
        'name'      => $request->name,
        'email'     => $request->email,
        'mobile'    => $request->mobile,
        'user_type' => Student::USER_STUDENT,
    ]);

    $identifier = $request->email ?? $request->mobile;

    $this->generateAndSendOtp($identifier, $student->id);

    return response()->json([
        'status'   => true,
        'message' => 'Registration successful. OTP sent.',
        'redirect'=> route('student.otp', [
            'identifier' => $identifier
        ])
    ]);
}


    /**
     * VERIFY OTP → LOGIN
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'identifier' => 'required',
            'otp' => 'required'
        ]);

        $otp = Otp::valid()
            ->where('identifier', $request->identifier)
            ->where('otp', $request->otp)
            ->first();

        if (!$otp) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid or expired OTP'
            ]);
        }

        $student = Student::findOrFail($otp->created_by);

        Auth::login($student, true);
        $otp->delete();

        return response()->json([
            'status' => true,
            'redirect' => route('student.dashboard')
        ]);
    }

    /**
     * Logout
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('student.login');
    }

    /**
     * COMMON OTP METHOD
     */
    private function generateAndSendOtp(string $identifier, int $studentId): void
    {
        $otp = rand(100000, 999999);

        Otp::updateOrCreate(
            ['identifier' => $identifier],
            [
                'otp'        => $otp,
                'expires_at'=> now()->addMinutes(5),
                'created_by'=> $studentId
            ]
        );

        // Email OTP
        if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
            Mail::raw("Your OTP is {$otp}", function ($msg) use ($identifier) {
                $msg->to($identifier)->subject('Login OTP');
            });
        }

        // SMS integration can be added here
    }
}
