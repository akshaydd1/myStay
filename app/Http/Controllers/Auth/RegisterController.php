<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\StudentRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        try {
            // Only check required fields and password confirmation
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'gender' => 'required',
                'date_of_birth' => 'required',
                'email' => 'required',
                'password' => 'required',
                'password_confirmation' => 'required',
            ]);

            // Check if password and confirm password match
            if ($request->password !== $request->password_confirmation) {
                return response()->json(['error' => 'Password and Confirm Password do not match.'], 422);
            }

            $data = $request->only([
                'first_name',
                'last_name',
                'gender',
                'date_of_birth',
                'email',
                'phone_number',
                'address',
                'city',
                'state',
                'pincode',
                'room_number',
            ]);

            // If password is not provided, set a default password
            $password = $request->password ? $request->password : 'Default@123';


            $data['password'] = bcrypt($password);

            if ($request->hasFile('gov_doc')) {
                $file = $request->file('gov_doc');
                $filename = time().'_'.$file->getClientOriginalName();
                $path = $file->storeAs('gov_docs', $filename, 'public');
                $data['gov_doc'] = $path;
            }

            $student = \App\Models\StudentRegistration::create($data);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
