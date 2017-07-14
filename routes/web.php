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

Auth::routes();

Route::get('/', function () {
	return view('welcome');
});

Route::get('/home', 'HomeController@index');

Route::group([ 'as'         => 'admin.',
               'middleware' => ['auth'],
               'namespace'  => 'Admin' ,
               'prefix'     => 'admin' ], function() {

	Route::get('/', [ 'as' => 'index', function() {
		return view('admin.index');
	}]);

	Route::group([ 'as' => 'board.', 'prefix' => 'board' ], function() {

		Route::get('/', [
			'as'   => 'index',
			'uses' => 'BoardController@index',
		]);

		Route::post('renewCharge', [
			'as'   => 'renewCharge',
			'uses' => 'BoardController@renewCharge',
		]);

		Route::post('endChargePeriod', [
			'as'   => 'endChargePeriod',
			'uses' => 'BoardController@endChargePeriod',
		]);

	});

	Route::resource('activities'   , 'ActivityController'    );
	Route::resource('charges'      , 'ChargeController'      );
	Route::resource('exchanges'    , 'ExchangeController'    );
	Route::resource('notifications', 'NotificationController');
	Route::resource('users'        , 'UserController'        );
	Route::resource('mbMembers'    , 'MbMemberController'    );
	Route::resource('workingGroups', 'WorkingGroupController');

	Route::post('users/{user}/renew', [
		'as'   => 'users.renew',
		'uses' => 'UserController@renew',
	]);

	Route::post('mbMembers/{mbMember}/renew', [
		'as'   => 'mbMembers.renew',
		'uses' => 'MbMemberController@renew',
	]);

});
