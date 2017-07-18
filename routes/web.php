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

Route::get('/home', 'HomeController@index');

Route::group([ 'as'         => 'admin.',
               'middleware' => ['auth'],
               'namespace'  => 'Admin' ,
               'prefix'     => 'admin' ], function() {

	Route::get('/', [
		'as' => 'index', 'uses' => 'Admin\IndexController@index',
	]);

	Route::get('board', [
		'as' => 'board', 'uses' => 'BoardController@index',
	]);
	
	Route::resource('charges', 'ChargeController');

	Route::get('charges/{charge}/assign', [
		'as' => 'charges.assign', 'uses' => 'ChargeController@assign',
	]);

	Route::group([ 'as' => 'chargePeriods.', 'prefix' => 'chargePeriods'], function() {

		Route::post('/', [
			'as' => 'store', 'uses' => 'ChargePeriodController@store',
		]);

		Route::get('/{chargePeriod}/manage', [
			'as' => 'manage', 'uses' => 'ChargePeriodController@manage',
		]);

		Route::post('/{chargePeriod}/extend', [
			'as' => 'extend', 'uses' => 'ChargePeriodController@extendPeriod',
		]);

		Route::post('/{chargePeriod}/finish', [
			'as' => 'finish', 'uses' => 'ChargePeriodController@finishPeriod',
		]);

	});

	Route::resource('workingGroups', 'WorkingGroupController');
	
	Route::resource('activities'   , 'ActivityController'    );
	Route::resource('exchanges'    , 'ExchangeController'    );
	Route::resource('users'        , 'UserController'        );

});
