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

	Route::get('board', [ 'as' => 'board', function() {
		return view('admin.board.index');
	}]);

	Route::resource('activities'   , 'ActivityController'    );
	Route::resource('exchanges'    , 'ExchangeController'    );
	Route::resource('users'        , 'UserController'        );
	Route::resource('charges'      , 'ChargeController'      );
	Route::resource('workingGroups', 'WorkingGroupController');

});
