<?php

namespace Avem\Http\Controllers\Auth;

use Avem\User;
use Illuminate\Http\Request;
use Avem\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Register Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users as well as their
	| validation and creation. By default this controller uses a trait to
	| provide this functionality without requiring any additional code.
	|
	*/

	use RegistersUsers;

	/**
	 * Where to redirect users after registration.
	 *
	 * @var string
	 */
	protected $redirectTo = '/usuario';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data)
	{
		return Validator::make($data, [
			'name' => 'required|max:255',
			'surname' => 'required|max:255',
			'password' => 'required|min:6|confirmed',
			'email' => 'required|email|max:255|unique:users|unique:charges',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	protected function create(array $data)
	{
		return User::create([
			'name'     => $data['name'],
			'surname'  => $data['surname'],
			'birthday' => $data['birthday'],
			'email'    => $data['email'],
			'gender'   => $data['gender'],
			'password' => bcrypt($data['password']),
		]);
	}

	/**
	 * The user has been registered.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  mixed  $user
	 * @return mixed
	 */
	protected function registered(Request $request, User $user)
	{
		if ($request->hasFile('photo'))
			$user->addMediaFromRequest('photo')->toMediaLibrary('avatars');
	}
}
