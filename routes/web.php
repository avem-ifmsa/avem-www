<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return view('welcome');
});

Route::group([ 'as' => 'auth.' ], function() {

	Route::get('register', [ 'as' => 'register', function() {
		return view('register')->with([
			'title' => 'Registrarse',
		]);
	}]);

	Route::get('login', [ 'as' => 'login', function() {
		return view('login')->with([
			'title' => 'Iniciar sesión',
		]);
	}]);

	Route::get('auth/callback', [
		'as'   => 'callback',
		'uses' => '\Auth0\Login\Auth0Controller@callback',
	]);

	Route::post('logout', [ 'as' => 'logout', function() {
		Auth::logout();
		return Redirect::home();
	}]);

});

Route::group([ 'as'         => 'admin.',
               'middleware' => ['auth'],
               'namespace'  => 'Admin' ,
               'prefix'     => 'admin' ], function() {

	Route::get('/', function() {
		return view('admin')->with([
			'title' => 'Panel de administración',
		]);
	});

	Route::resource('activities'   , 'ActivityController');
	Route::resource('exchanges'    , 'ExchangeController');
	Route::resource('notifications', 'NotificationController');
	Route::resource('users'        , 'UserController');

	Route::get('mboard', [ 'as' => 'mboard', function() {
		return view('admin.mboard')->with([
			'title' => 'Gestión de junta directiva',
		]);
	}]);

	Route::get('analytics', [ 'as' => 'analytics', function() {
		return view('admin.analytics')->with([
			'title' => 'Analíticas',
		]);
	}]);

});
