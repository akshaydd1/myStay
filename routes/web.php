<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentRegistration;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\HostelStudent;

Route::get('/', function () {
    return view('landing');
});

Route::get('/registration', function () {
    return view('registration');
})->name('registration');

Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');

Route::get('/login', function () {
    return view('login');
})->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/dashboard', function () {
    $student = null;
    if (session()->has('student_id')) {
        $student = StudentRegistration::find(session('student_id'));
        if ($student && $student->is_admin) {
            // Redirect admin to the correct dashboard route
            return redirect()->route('admin_dashboard');
        }
    }
    return view('dashboard', compact('student'));
})->middleware('web')->name('dashboard');

Route::get('/admin_dashboard', function () {
    if (session()->has('student_id')) {
        $student = App\Models\StudentRegistration::find(session('student_id'));
        if ($student && $student->is_admin) {
            $users = App\Models\StudentRegistration::all();
            $hostelStudents = App\Models\HostelStudent::with('student')->get();
            return view('admin_dashboard', compact('users', 'hostelStudents'));
        }
    }
    return redirect('/login');
})->middleware('web')->name('admin_dashboard');

Route::post('/logout', function () {
    session()->forget('student_id');
    return redirect('/');
})->name('logout');

Route::get('/password/forgot', function () {
    return view('auth.passwords.email');
})->name('password.request');

Route::post('/password/email', function (\Illuminate\Http\Request $request) {
    $request->validate(['email' => 'required|email']);
    $student = App\Models\StudentRegistration::where('email', $request->email)->first();
    if (!$student) {
        return back()->withErrors(['email' => 'We can\'t find a user with that email address.']);
    }
    $token = Str::random(60);
    \DB::table('password_resets')->updateOrInsert(
        ['email' => $request->email],
        [
            'email' => $request->email,
            'token' => $token,
            'created_at' => now(),
        ]
    );
    $resetLink = url('/password/reset/' . $token . '?email=' . urlencode($request->email));
    Mail::raw('Click here to reset your password: ' . $resetLink, function ($message) use ($request) {
        $message->to($request->email)->subject('Reset Password');
    });
    return back()->with('status', 'We have emailed your password reset link!');
})->name('password.email');

Route::get('/password/reset/{token}', function ($token, \Illuminate\Http\Request $request) {
    $email = $request->query('email');
    return view('auth.passwords.reset', compact('token', 'email'));
})->name('password.reset');

Route::post('/password/reset', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|confirmed',
        'token' => 'required',
    ]);
    $reset = \DB::table('password_resets')->where([
        ['email', $request->email],
        ['token', $request->token],
    ])->first();
    if (!$reset) {
        return back()->withErrors(['email' => 'Invalid or expired token.']);
    }
    $student = App\Models\StudentRegistration::where('email', $request->email)->first();
    if (!$student) {
        return back()->withErrors(['email' => 'No user found.']);
    }
    $student->password = bcrypt($request->password);
    $student->save();
    \DB::table('password_resets')->where('email', $request->email)->delete();
    return redirect('/login')->with('status', 'Password has been reset!');
})->name('password.update');

Route::post('/hostel-students', function (Request $request) {
    $request->validate([
        'student_id' => 'required|exists:student_registrations,student_id',
        'room_number' => 'nullable|string|max:10',
        'admission_in_date' => 'required|date',
        'bed_number' => 'nullable|string|max:10',
        'deposit_amount' => 'nullable|numeric',
        'rent_amount' => 'nullable|numeric',
    ]);
    HostelStudent::create($request->only([
        'student_id',
        'room_number',
        'admission_in_date',
        'bed_number',
        'deposit_amount',
        'rent_amount',
    ]));
    return Redirect::back()->with('status', 'Student added to hostel successfully!');
})->name('hostel-students.store');
