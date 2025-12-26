<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('parent.login');
});

/*
|--------------------------------------------------------------------------
| STUDENT AUTH (OTP LOGIN)
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\StudentAuthController;

Route::prefix('student')->middleware('guest')->group(function () {

    Route::get('/login', [StudentAuthController::class, 'showLogin'])
        ->name('student.login');

    Route::get('/signup', [StudentAuthController::class, 'showSignup'])
        ->name('student.signup');

    Route::get('/otp', function (Request $request) {
        return view('auth.otp', [
            'identifier' => $request->identifier
        ]);
    })->name('student.otp');

    Route::post('/send-otp', [StudentAuthController::class, 'sendOtp'])
        ->name('student.sendOtp');

    Route::post('/verify-otp', [StudentAuthController::class, 'verifyOtp'])
        ->name('student.verifyOtp');

    Route::post('/register', [StudentAuthController::class, 'register'])
        ->name('student.register');
});

Route::middleware('auth')->group(function () {
    Route::get('/student/dashboard', function () {
        return view('student.dashboard');
    })->name('student.dashboard');

    Route::post('/student/logout', [StudentAuthController::class, 'logout'])
        ->name('student.logout');
});

use App\Http\Controllers\InstituteAuthController;
use App\Http\Controllers\InstituteStudentController;

/*
|--------------------------------------------------------------------------
| INSTITUTE AUTH (GUEST)
|--------------------------------------------------------------------------
*/

Route::prefix('institute')->middleware('guest')->group(function () {

    Route::get('/register', [InstituteAuthController::class, 'showRegister'])
        ->name('institute.register');

    Route::post('/register', [InstituteAuthController::class, 'register'])
        ->name('institute.register.submit');

    Route::get('/login', [InstituteAuthController::class, 'showLogin'])
        ->name('institute.login');

    Route::post('/login', [InstituteAuthController::class, 'login'])
        ->name('institute.login.submit');
});


/*
|--------------------------------------------------------------------------
| INSTITUTE DASHBOARD (AUTHENTICATED)
|--------------------------------------------------------------------------
*/
Route::prefix('institute')
    ->middleware('auth:institute')
    ->name('institute.')
    ->group(function () {

        // Institute Profile
        Route::get('/profile', function () {
            return view('institute.profile');
        })->name('profile');

        // Dashboard
        Route::get('/dashboard', function () {
            return view('institute.dashboard');
        })->name('dashboard');

        // =====================
        // STUDENTS
        // =====================
        Route::get('/students', [InstituteStudentController::class, 'index'])
            ->name('students.index');

        Route::get('/students/create', [InstituteStudentController::class, 'create'])
            ->name('students.create');

        Route::post('/students/store', [InstituteStudentController::class, 'store'])
            ->name('students.store');
        Route::get(
            'students/{student}',
            [InstituteStudentController::class, 'show']
        )->name('students.show');


        Route::post('/students/import', [InstituteStudentController::class, 'import'])
            ->name('students.import');

        // Logout
        Route::post('/logout', [InstituteAuthController::class, 'logout'])
            ->name('logout');
    });

/*
|--------------------------------------------------------------------------
| ADMIN AUTH
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminInstituteController;

Route::prefix('admin')->middleware('guest')->group(function () {

    Route::get('/login', [AdminAuthController::class, 'showLogin'])
        ->name('admin.login');

    Route::post('/login', [AdminAuthController::class, 'login'])
        ->name('admin.login.submit');
});

Route::middleware('auth:admin')->prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminInstituteController::class, 'index'])
        ->name('admin.dashboard');


    Route::post('/institute/{id}/toggle', [AdminInstituteController::class, 'toggle'])
        ->name('admin.institute.toggle');

    Route::post('/logout', function () {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    })->name('admin.logout');
});

use App\Http\Controllers\ParentAuthController;
use App\Http\Controllers\ParentDashboardController;
use App\Http\Controllers\ParentStudentController;
use App\Http\Controllers\ParentTransactionController;
use App\Http\Controllers\ParentPaymentController;

Route::prefix('parent')->group(function () {

    Route::get('/login', [ParentAuthController::class, 'loginView'])
    ->name('parent.login');

    Route::post('/send-otp', [ParentAuthController::class, 'sendOtp'])
        ->name('parent.sendOtp');

    Route::get('/otp', [ParentAuthController::class, 'otpView'])
        ->name('parent.otp');

        Route::post('/verify-otp', [ParentAuthController::class, 'verifyOtp'])
        ->name('parent.verifyOtp');
        Route::post('/resend-otp', [ParentAuthController::class, 'resendOtp'])
        ->name('parent.resendOtp');

        Route::middleware('auth:parent')->group(function () {
            Route::get('/dashboard', [ParentDashboardController::class, 'index'])
            ->name('parent.dashboard');
        Route::get('/transactions', [ParentTransactionController::class, 'index'])
        ->name('parent.transactions');
        Route::get('/student/{id}', [ParentStudentController::class, 'show'])
        ->name('parent.student.show');
        Route::post('/parent/pay-selected', [ParentPaymentController::class, 'paySelected'])
        ->name('parent.pay.selected');

        Route::post('/logout', [ParentAuthController::class, 'logout'])
        ->name('parent.logout');
    });
});
use App\Http\Controllers\InstitutePaymentController;

Route::get('/payments/transactions', [InstitutePaymentController::class, 'transactions'])
    ->name('institute.transactions');
