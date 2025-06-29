<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\StudentRegistration;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $student = StudentRegistration::where('email', $credentials['email'])->first();
        if ($student && $student->password && Hash::check($credentials['password'], $student->password)) {
            session(['student_id' => $student->student_id]);
            if ($student->is_admin) {
                return redirect()->intended('/admin_dashboard');
            }
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
