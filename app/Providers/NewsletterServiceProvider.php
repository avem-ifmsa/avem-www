<?php

namespace Avem\Providers;

use Avem\User;
use Illuminate\Support\ServiceProvider;
use Avem\Observers\NewsletterUserObserver;

class NewsletterServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		User::observe(NewsletterUserObserver::class);
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}
}
