<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Member;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

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

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

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
            'first_name' => [ 'required', 'max:255' ],
            'last_name' => [ 'required', 'max:255' ],
            'birthday' => [ 'date', 'before:today' ],
            'email' => [ 'required', 'email', 'max:255', 'unique:users'],
            'password' => [
                'required', 'confirmed',
                'min:'.config('security.min_password_length')
            ],
        ]);
    }

    private function createUser(array $data) {
        $user = User::create($data);
        $member = $this->createMember($user, $data);
        $user->save();
        return $user;
    }

    private function createMember(User $user, array $data) {
        $member = new Member($data);
        $member->user()->associate($user);
        $member->save();
        return $member;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return $this->createUser($data);
    }
}
