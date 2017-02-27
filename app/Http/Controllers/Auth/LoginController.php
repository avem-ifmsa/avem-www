<?php

namespace Avem\Http\Controllers\Auth;

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
	protected $redirectTo = '/home';

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
	 * @param  mixed  $user
	 * @return mixed
	 */
	protected function authenticated (Request $request, $user)
	{
		return redirect()->intended($this->redirectTo);
	}

	private function attemptChargeLogin(Request $request)
	{
		$username = $this->username();
		$email = $request->input($username);
		$charge = Charge::where('email', $email)->first();
		if ($charge == null) return;

		$activePeriods = $charge->mbMemberPeriods()->active();
		if ($activePeriods->count() != 1) return;

		if ($mbMember = $activePeriods->first()->mbMember)
			$request->merge([ $username => $mbMember->user->email ]);
	}

	/**
	 * Get the needed authorization credentials from the request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	protected function credentials(Request $request)
	{
		$this->attemptChargeLogin($request);

		return $request->only($this->username(), 'password');
	}
}
