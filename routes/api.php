<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([ 'namespace'  => 'Api'      ,
               'middleware' => 'auth:api' ], function() {

	Route::get('user', function(Request $request) {
		return $request->user();
	});

	Route::group([ 'as'     => 'search.' ,
	               'prefix' => 'search'  ], function() {
		
		Route::get('users', 'SearchController@searchUsers');
		Route::get('exchanges', 'SearchController@searchExchanges');
		Route::get('activities', 'SearchController@searchActivities');
	
	});

});