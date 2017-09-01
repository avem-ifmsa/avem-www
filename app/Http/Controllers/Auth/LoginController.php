<?php

namespace Avem\Http\Controllers\Auth;

use Hash;
use Avem\User;
use Avem\Charge;
use Illuminate\Http\Request;
use Avem\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles authenticating users for the application and
	| redirecting them to your home screen. The controller uses a trait
	| to conveniently provide its functionality to your applications.
	|
	*/

	use AuthenticatesUsers;

	/**
	 * Where to redirect users after login.
	 *
	 * @var string
	 */
	protected $redirectTo = '/usuario';

	/**
	 * Indicates current request is charge login.
	 *
	 * @var boolean
	 */
	private $chargeLogin = false;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest', ['except' => 'logout']);
	}

	/**
	 * The user has been authenticated.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  User  $user
	 * @return mixed
	 */
	protected function authenticated(Request $request, User $user)
	{
		if ($this->chargeLogin)
			return redirect()->intended('/admin');
	}

	/**
	 * Check if login is done with charge credentials.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return mixed
	 */
	private function isChargeLogin(Request $request)
	{
		$username = $this->username();
		$chargeEmail = $request->input($username);
		$charge = Charge::where('email', $chargeEmail)->first();
		if ($charge == null)
			return null;

		$password = $request->input('password');
		$activePeriods = $charge->periods()->active()->get();
		$users = $activePeriods->pluck('user')->filter(function($user) use ($password) {
			return Hash::check($password, $user->password);
		});

		if ($users->count() !== 1)
			return null;

		return [
			$username  => $users[0]->email, 'password' => $password,
		];
	}

	/**
	 * Get the needed authorization credentials from the request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	protected function credentials(Request $request)
	{
		if ($creds = $this->isChargeLogin($request)) {
			$this->chargeLogin = true;
			return $creds;
		}

		return $request->only($this->username(), 'password');
	}
}
