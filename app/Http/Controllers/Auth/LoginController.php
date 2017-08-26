<?php

namespace Avem\Http\Controllers\Auth;

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
	private $isChargeLogin = false;

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
		if ($this->isChargeLogin)
			return redirect()->intended('/admin');
	}

	/**
	 * Check if login is done with charge credentials.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return mixed
	 */
	private function checkChargeLogin(Request $request)
	{
		$username = $this->username();
		$chargeEmail = $request->input($username);
		$charge = Charge::where('email', $chargeEmail)->first();
		if ($charge == null)
			return null;

		$activePeriods = $charge->mbMemberPeriods()->active();
		if ($activePeriods->count() != 1)
			return null;

		$mbMember = $activePeriods->first()->mbMember;
		if (!$mbMember)
			return null;

		return [
			$username  => $mbMember->user->email,
			'password' => $request->input('password'),
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
		if ($creds = $this->checkChargeLogin($request)) {
			$this->isChargeLogin = true;
			return $creds;
		}

		return $request->only($this->username(), 'password');
	}
}
