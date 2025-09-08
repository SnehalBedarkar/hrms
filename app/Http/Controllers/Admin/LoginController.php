<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function loginSubmit(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $rules = [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8'
        ];

        $validator = Validator::make($credentials, $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('admin/dashboard');
        } else {
            return back()->withInput($request->only('email'));
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
