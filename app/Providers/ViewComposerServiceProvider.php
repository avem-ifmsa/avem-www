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
