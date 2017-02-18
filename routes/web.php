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

Route::get('/home', 'HomeController@index');

Route::group([ 'as' => 'auth.' ], function() {
	Auth::routes();
});

Route::group([ 'as'         => 'admin.',
               'middleware' => ['auth'],
               'namespace'  => 'Admin' ,
               'prefix'     => 'admin' ], function() {

	Route::get('/', [ 'as' => 'index', function() {
		return view('admin.index');
	}]);

	Route::get('mboard', [ 'as' => 'mboard', function() {
		return view('admin.mboard');
	}]);

	Route::get('analytics', [ 'as' => 'analytics', function() {
		return view('admin.analytics');
	}]);

	Route::resource('activities'    , 'ActivityController'    );
	Route::resource('charges'       , 'ChargeController'      );
	Route::resource('exchanges'     , 'ExchangeController'    );
	Route::resource('notifications' , 'NotificationController');
	Route::resource('users'         , 'UserController'        );
	Route::resource('mb-members'    , 'MbMemberController'    );
	Route::resource('working-groups', 'WorkingGroupController');

});
