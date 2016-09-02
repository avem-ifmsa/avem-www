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

Route::get('/', function() {
	return view('welcome');
});

Route::auth();

// verification token resend form
Route::get('verify/resend', [
    'uses' => 'Auth\VerifyController@showResendForm',
    'as' => 'verification.resend',
]);

// verification token resend action
Route::post('verify/resend', [
    'uses' => 'Auth\VerifyController@sendVerificationLinkEmail',
    'as' => 'verification.resend.post',
]);

// verification message / user verification
Route::get('verify/{token?}', [
    'uses' => 'Auth\VerifyController@verify',
    'as' => 'verification.verify',
]);

Route::group(['middleware' => 'auth'], function() {

	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/admin', 'AdminController@index')->name('admin');

	Route::get('/admin/manage', 'AdminController@manage');
	Route::resource('/admin/manage/users', 'Admin\Manage\UserController');
	Route::resource('/admin/manage/roles', 'Admin\Manage\RoleController');
	Route::resource('/admin/manage/members', 'Admin\Manage\MemberController');
	Route::resource('/admin/manage/activities', 'Admin\Manage\ActivityController');
	Route::resource('/admin/manage/mb-members', 'Admin\Manage\MbMemberController');
	Route::resource('/admin/manage/mb-charges', 'Admin\Manage\MbChargeController');
	Route::resource('/admin/manage/permissions', 'Admin\Manage\PermissionController');

	Route::get('/admin/renewals', 'Admin\RenewalsController@index');
	Route::post('/admin/renewals/{members}/renew', 'Admin\RenewalsController@renew')
		->name('admin.renewals.renew');

	Route::get('/admin/mb-members', 'Admin\MbMembersController@index');
	Route::post('/admin/mb-members/{mb_members}/activate', 'Admin\MbMembersController@activate')
		->name('admin.mbMembers.activate');

	Route::get('/admin/activities', 'AdminController@activities');
	Route::get('/admin/exchanges', 'AdminController@exchanges');

});
