<?php

namespace Avem\Providers;

use Avem\User;
use Illuminate\Support\ServiceProvider;
use Avem\Observers\MailchimpUserObserver;

class MailchimpServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		User::observe(MailchimpUserObserver::class);
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
