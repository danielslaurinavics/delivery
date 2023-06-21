<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ],[
			'email' => __('validation.erequired'),
			'email.email' => __('validation.email'),
			'password' => __('validation.prequired'),
		]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
			
			if(auth()->user()->is_blocked)
			{
				Auth::logout();
				return redirect()->back()->withErrors(['error' => __('messages.account_blocked'),]);
			}

            return redirect()->intended('/');
        }

        return redirect()->back()->withErrors(['error' => __('messages.auth_failed')]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}