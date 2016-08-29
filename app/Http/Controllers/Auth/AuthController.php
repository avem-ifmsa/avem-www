<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Krucas\LaravelUserEmailVerification\AuthenticatesAndRegistersUsers as VerificationAuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins, VerificationAuthenticatesAndRegistersUsers {
            AuthenticatesAndRegistersUsers::redirectPath insteadof VerificationAuthenticatesAndRegistersUsers;
            AuthenticatesAndRegistersUsers::getGuard insteadof VerificationAuthenticatesAndRegistersUsers;
            VerificationAuthenticatesAndRegistersUsers::register insteadof AuthenticatesAndRegistersUsers;
    }

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
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
            'first_name' => 'required',
            'last_name' => 'required',
            'birthday' => [ 'date', 'before:today' ],
            'email' => [ 'required', 'email', 'max:255', 'unique:users' ],
            'password' => [
                'required', 'confirmed',
                'min:'.config('security.min_password_length')
            ],
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
        $user = User::create($data);
        $member = Member::create($data);
        $user->member()->save($member);
        return $user;
    }

}
