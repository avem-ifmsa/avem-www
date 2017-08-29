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

Route::get('/junta', [
	'as' => 'board', 'uses' => 'MainController@board',
]);

Route::get('/about', [
	'as' => 'about', 'uses' => 'MainController@about',
]);

Route::group([ 'middleware' => 'auth' ], function() {

	Route::get('/usuario', [
		'as' => 'home', 'uses' => 'HomeController@index',
	]);

	Route::get('/usuario/desglose', [
		'as' => 'home.points', 'uses' => 'HomeController@transactions',
	]);

	Route::get('/usuario/tickets/canjear', [
		'as' => 'ticket.exchange', 'uses' => 'TicketController@input',
	]);


	Route::post('/usuario/tickets/canjear', [
		'as' => 'ticket.exchange', 'uses' => 'TicketController@exchange',
	]);

	Route::get('/usuario/eliminar', [
		'as' => 'account.delete', 'uses' => 'SettingsController@deleteAccount',
	]);

	Route::post('/usuario/eliminar', [
		'as' => 'account.delete.confirm', 'uses' => 'SettingsController@confirmDeleteAccount'
	]);

	Route::get('/usuario/ajustes', [
		'as' => 'home.settings', 'uses' => 'SettingsController@index',
	]);

	Route::post('/usuario/ajustes', [
		'as' => 'home.settings.store', 'uses' => 'SettingsController@store',
	]);

	Route::post('/usuario/correos/suscribirme', [
		'as' => 'newsletter.subscribe', 'uses' => 'SettingsController@subscribeNewsletter',
	]);

	Route::post('/usuario/correos/desuscribirme', [
		'as' => 'newsletter.unsubscribe', 'uses' => 'SettingsController@unsubscribeNewsletter',
	]);

});

Route::group([ 'as'         => 'admin.',
               'middleware' => ['auth'],
               'namespace'  => 'Admin' ,
               'prefix'     => 'admin' ], function() {

	Route::get('/', [
		'as' => 'index', 'uses' => 'IndexController@index',
	]);

	Route::group([], function() {

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

	});

	Route::group([], function() {

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

	});

	Route::group([], function() {

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

	});

	// Route::resource('exchanges', 'ExchangeController');

});
