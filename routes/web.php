<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentRegistration;

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
    }
    return view('dashboard', compact('student'));
})->middleware('web')->name('dashboard');

Route::post('/logout', function () {
    session()->forget('student_id');
    return redirect('/');
})->name('logout');
