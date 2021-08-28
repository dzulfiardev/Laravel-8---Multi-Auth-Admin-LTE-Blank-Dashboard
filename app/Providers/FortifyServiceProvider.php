<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\LogoutResponse;


class FortifyServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->instance(LogoutResponse::class, new class implements LogoutResponse
		{
			public function toResponse($request)
			{
				return redirect('/');
			}
		});
	}

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		Fortify::loginView(function () {
			$data = [
				'title' => 'Login'
			];
			return view('auth.login', $data);
		});

		Fortify::authenticateUsing(function (Request $request) {
			$user = User::where('email', $request->email)->first();

			if ($user && Hash::check($request->password, $user->password)) {
				return $user;
			}
		});

		Fortify::registerView(function () {
			$role = Role::all();
			$data = [
				'title' => 'Register',
				'role' => $role
			];
			return view('auth.register', $data);
		});

		Fortify::createUsersUsing(CreateNewUser::class);
		Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
		Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
		Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

		RateLimiter::for('login', function (Request $request) {
			return Limit::perMinute(5)->by($request->email . $request->ip());
		});

		RateLimiter::for('two-factor', function (Request $request) {
			return Limit::perMinute(5)->by($request->session()->get('login.id'));
		});
	}
}
