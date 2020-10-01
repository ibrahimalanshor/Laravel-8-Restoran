<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Site;

class SettingController extends Controller
{

	public function index()
	{
		$site = Site::firstOrFail();

		return view('admin.setting', compact('site'));
	}

	public function update(Request $request)
	{
		$request->validate([
			'name' => 'required|string',
			'address' => 'required|string'
		]);
		
		Site::first()->update($request->all());

		return back()->with('success', 'Success Update Site');
	}
}
