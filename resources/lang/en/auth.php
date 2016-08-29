<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed' => 'These credentials do not match our records.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',

    'register' => [
        'title' => 'AVEM / Register',
        'header' => 'Register',
        'email' => 'Email Address',
        'password' => 'Password',
        'passwordConfirm' => 'Confirm Password',
        'registerButton' => 'Register',
    ],

    'registerMember' => [
        'title' => 'AVEM / Register Member',
        'header' => 'Register Member',
        'firstName' => 'First Name',
        'lastName' => 'Last Name',
        'birthday' => 'Birthday',
        'registerButton' => 'Register',
    ],

    'login' => [
        'header' => 'Login',
        'title' => 'AVEM / Login',
        'email' => 'Email Address',
        'password' => 'Password',
        'loginButton' => 'Login',
        'rememberMe' => 'Remember Me',
        'forgotPassword' => 'Forgot Your Password?',
        'verificationRequired' => 'You need to confirm your account.'
            .' We have sent you an activation code, please check your email.',
    ],

    'verify' => [
        'header' => 'Verify Account',
        'title' => 'AVEM / Verify Account',
        'verificationMailSent' => 'A verification mail has been sent.'
            .' You should check your inbox to continue registration.',
    ],

];
