<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    // show login page
    public function login(Request $request)
    {
        return view('auth.login');
    }

    // try login with password
    public function tryLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|exists:admin,username',
            'password' => 'required',
        ], [
            'username.exists' => 'The provided username does not exist in our records.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->withInput();
        }
        $user = User::where('username', $request->username)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'User does not exist.')->withInput();
        }
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->with('error', 'Invalid credentials.')->withInput();
        }
        Auth::guard('user')->loginUsingId($user->id);

        return redirect(route('user.dashboard'))->with('success', 'Logged in successfully.');
    }

    // current auth logout
    public function logout(Request $request)
    {
        auth()->guard('user')->logout();
        return redirect(route('login'))->with('success', 'Logout Successfully'); // code here
    }
}
