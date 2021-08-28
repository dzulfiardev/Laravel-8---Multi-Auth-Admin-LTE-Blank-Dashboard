<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
	public function index()
	{
		$userModel = new User;
		$profile = $userModel->profile(Auth::user()->id);

		$data = [
			'title' => 'Profile',
			'profile' => $profile
		];
		return view('main.profile', $data);
	}

	public function update(Request $request, $id)
	{
		$image = $request->image;
		$imageOld = $request->input('image_old');

		// Email Rule Conditions
		$user = User::find($id);
		if ($user->email == $request->input('email')) {
			$rule = 'required';
		} else {
			$rule = 'required|unique:users';
		}

		$validated = $request->validate([
			'name' => 'required',
			'email' => $rule,
			'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024'
		]);

		if ($validated) {

			if ($image) {
				$imageName = Auth::user()->name . '-' . time() . '.' . $image->extension();
				if ($imageOld == 'default.jpg') {
					$image->move(public_path('image/profile'), $imageName);
				} else {
					$image->move(public_path('image/profile'), $imageName);
					File::delete('image/profile/' . $imageOld);
				}
			} else {
				$imageName = $imageOld;
			}

			$data = [
				'name' => $request->input('name'),
				'email' => $request->input('email'),
				'image' => $imageName
			];

			User::where('id', $id)->update($data);

			return redirect('/profile')->with('status', 'Profile Updated');
		} else {
			return redirect('/profile')
				->withErrors($validated)
				->withInput();
		}
	}
}
