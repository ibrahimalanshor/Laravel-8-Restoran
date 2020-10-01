<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

class LoginController extends Controller
{

	public function __construct()
	{
		$this->middleware('guest:admin', ['except' => 'logout']);
	}

	public function showLoginForm()
	{
		return view('admin.auth.login');
	}

	public function login(Request $request)
	{
		$request->validate([
			'email' => 'required|email|exists:admins',
			'password' => 'required'
		]);

		if (Auth::guard('admin')->attempt($request->only('email', 'password'), $request->get('remember'))) {
			return redirect('admin');
		}

		return back()->withInput($request->only('email', 'remember'));
	}
}
