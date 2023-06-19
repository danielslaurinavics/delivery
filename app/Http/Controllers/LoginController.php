<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
			
			if(auth()->user()->is_blocked)
			{
				Auth::logout();
				throw ValidationException::withMessages([
                'auth' => __('messages.account_blocked'),]);
			}

            return redirect()->intended('/');
        }

        throw ValidationException::withMessages([
			'auth' => __('messages.auth_failed'),
			'email' => __('validation.email'),
			'password' => __('validation.required'),
		]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}