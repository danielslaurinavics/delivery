<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    public function register ()
	{
		return view('register');
	}
	
	public function store (Request $request)
	{
		$request->validate([
			'email' => 'required|email|unique:users|max:255',
			'name' => 'required|max:255',
			'password' => 'required|min:8|confirmed',
		] , [
			'name.required' => __('messages.nr'),
			'name.max' => __('messages.nm'),
			'email.required' => __('messages.er'),
			'email.email' => __('messages.ee'),
			'email.max' => __('messages.em'),
			'email.unique' => __('messages.eu'),
			'password.required' => __('messages.pr'),
			'password.min' => __('messages.pm'),
			'password.confirmed' => __('messages.pc'),
		]);
		
		$user = new User;
		$user->name = $request->input('name');
		$user->email = $request->input('email');
		$user->password = Hash::make($request->input('password'));
		$user->save();
		
		return redirect()->route('welcome')->withErrors(['error' => __('messages.regsuccess')]);
	}
}
