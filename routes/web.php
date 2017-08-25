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

Route::get('/', [
	'as' => 'welcome', 'uses' => 'MainController@index',
]);

Route::get('/actividades', [
	'as' => 'activities', 'uses' => 'ActivityController@index',
]);

Route::post('/actividades/{activity}/subscribe', [
	'as' => 'activities.subscribe', 'uses' => 'ActivityController@subscribe',
]);

Route::post('/actividades/{activity}/unsubscribe', [
	'as' => 'activities.unsubscribe', 'uses' => 'ActivityController@unsubscribe',
]);

Route::get('/intercambios', [
	'as' => 'exchanges', 'uses' => 'MainController@exchanges',
]);

Route::get('/about', [
	'as' => 'about', 'uses' => 'MainController@about',
]);

Route::get('/home', [
	'as' => 'home', 'uses' => 'HomeController@index',
]);

Route::get('/home/ajustes', [
	'as' => 'home.settings', 'uses' => 'HomeController@settings',
]);

Route::get('/home/desglose', [
	'as' => 'home.points', 'uses' => 'HomeController@transactions',
]);

Route::get('/tickets/canjear', [
	'as' => 'tickets.exchange', 'uses' => 'HomeController@ticket',
]);

Route::group([ 'as'         => 'admin.',
               'middleware' => ['auth'],
               'namespace'  => 'Admin' ,
               'prefix'     => 'admin' ], function() {

	Route::get('/', [
		'as' => 'index', 'uses' => 'IndexController@index',
	]);

	Route::get('board', [
		'as' => 'board', 'uses' => 'BoardController@index',
	]);

	Route::resource('charges', 'ChargeController');

	Route::get('charges/{charge}/assign', [
		'as' => 'charges.assign', 'uses' => 'ChargeController@assign',
	]);

	Route::post('charges/{charge}/assign/confirm', [
		'as' => 'charges.assign.confirm', 'uses' => 'ChargeController@confirmAssign',
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

	Route::resource('activities', 'ActivityController');

	Route::post('activities/{activity}/publish', [
		'as' => 'activities.publish', 'uses' => 'ActivityController@publish',
	]);

	Route::get('activities/{activity}/delete', [
		'as' => 'activities.delete', 'uses' => 'ActivityController@confirmDelete'
	]);

	Route::resource('activities.tickets', 'ActivityTicketController');

	Route::get('activities/{activity}/tickets/{ticket}/expire', [
		'as' => 'activities.tickets.expire', 'uses' => 'ActivityTicketController@confirmExpire',
	]);

	Route::post('activities/{activity}/tickets/{ticket}/expire', [
		'as' => 'activities.tickets.expire', 'uses' => 'ActivityTicketController@expire'
	]);

	Route::get('activities/{activity}/assistants', [
		'as' => 'activities.assistants.index', 'uses' => 'ActivityAssistantController@index',
	]);

	Route::post('activities/{activity}/assistants/{user}/witness', [
		'as' => 'activities.assistants.witness', 'uses' => 'ActivityAssistantController@witness',
	]);

	Route::resource('users', 'UserController');

	Route::post('users/{user}/renew', [
		'as' => 'users.renew', 'uses' => 'UserController@renew',
	]);

	Route::get('users/{user}/delete', [
		'as' => 'users.delete', 'uses' => 'UserController@confirmDelete',
	]);

	Route::resource('users.transactions', 'TransactionController', [
		'only' => [ 'index', 'create', 'store' ],
	]);

	Route::resource('users.renewals', 'RenewalController', [
		'only' => [ 'create', 'store', 'delete' ],
	]);

	Route::get('users/{user}/renewals/{renewal}/delete', [
		'as' => 'users.renewals.confirmDelete', 'uses' => 'RenewalController@confirmDelete',
	]);

	Route::resource('exchanges', 'ExchangeController');

});
