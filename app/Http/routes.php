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

Route::group(['prefix' => 'admin'], function() {
    Route::get('/', 'Admin\AdminController@index');

    Route::get('manage', [ 'as' => 'admin.manage',
        'uses' => 'Admin\AdminController@manage'
    ]);

    Route::get('activities', [ 'as' => 'admin.activities',
        'uses' => 'Admin\AdminController@activities',
    ]);

    Route::get('renewals', [ 'as' => 'admin.renewals',
        'uses' => 'Admin\AdminController@renewals'
    ]);

    Route::get('exchanges', [ 'as' => 'admin.exchanges',
        'uses' => 'Admin\AdminController@exchanges'
    ]);

    Route::get('analytics', [ 'as' => 'admin.analytics',
        'uses' => 'Admin\AdminController@analytics'
    ]);

    Route::group(['prefix' => 'manage'], function() {
        Route::resource('users', 'Admin\UserController');
        Route::resource('roles', 'Admin\RoleController');
        Route::resource('members', 'Admin\MemberController');
        Route::resource('activities', 'Admin\ActivityController');
        Route::resource('mb_members', 'Admin\MbMemberController');
        Route::resource('mb_charges', 'Admin\MbChargeController');
        Route::resource('permissions', 'Admin\PermissionController');
    });
});
