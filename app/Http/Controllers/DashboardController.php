<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
	public function index()
	{
		$userModel = new User;
		$profile = $userModel->profile(Auth::user()->id);

		// Admin Dashboard
		if (Auth::user()->hasRole('admin')) {
			$data = [
				'profile' => $profile,
				'title' => 'Admin Dashboard'
			];
			return view('main.dashboard-admin', $data);
		}

		// User Dashboard
		if (Auth::user()->hasRole('user')) {
			$data = [
				'profile' => $profile,
				'title' => 'User Dashboard'
			];
			return view('main.dashboard-user', $data);
		}

		// Guest Dashboard
		if (Auth::user()->hasRole('guest')) {
			$data = [
				'profile' => $profile,
				'title' => 'Guest Dashboard',
			];
			return view('main/dashboard-guest', $data);
		}
	}
}
