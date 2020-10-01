<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Models\User;

class UserController extends Controller
{

	public function index()
	{
		$user = Auth::user();

		return view('user.index', compact('user'));
	}

	public function update(Request $request)
	{
		$id = Auth::id();

		$request->validate([
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:users,email,'.$id,
		]);

		User::findOrFail($id)->update($request->all());

		return redirect('user')->with('success', 'Success Update Account');
	}
}
