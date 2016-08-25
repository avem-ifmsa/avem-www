<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();

Route::get('/', function() {
	return view('welcome');
});

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function() {

	Route::get('/admin', 'AdminController@index');

	Route::get('/admin/manage', 'AdminController@manage');
	Route::resource('/admin/manage/users', 'Admin\UserController');
	Route::resource('/admin/manage/roles', 'Admin\RoleController');
	Route::resource('/admin/manage/members', 'Admin\MemberController');
	Route::resource('/admin/manage/activities', 'Admin\ActivityController');
	Route::resource('/admin/manage/mb-members', 'Admin\MbMemberController');
	Route::resource('/admin/manage/mb-charges', 'Admin\MbChargeController');
	Route::resource('/admin/manage/permissions', 'Admin\PermissionController');

	Route::get('/admin/renewals', 'AdminController@renewals');
	Route::post('/admin/members/{members}/renew', 'Admin\MemberController@renew');

	Route::get('/admin/exchanges', 'AdminController@exchanges');
	Route::get('/admin/mb-members', 'AdminController@mbMembers');
	Route::get('/admin/activities', 'AdminController@activities');

});
