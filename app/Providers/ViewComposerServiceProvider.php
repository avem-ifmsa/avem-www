<?php

namespace Avem\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		View::composer('main.home', 'Avem\Http\ViewComposers\HomeViewComposer');
		View::composer('admin.users.index', 'Avem\Http\ViewComposers\AdminUsersViewComposer');
		View::composer('admin.board.index', 'Avem\Http\ViewComposers\AdminBoardViewComposer');
		View::composer('admin.activities.index', 'Avem\Http\ViewComposers\AdminActivityViewComposer');
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}
}
