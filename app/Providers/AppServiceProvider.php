<?php

namespace Avem\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		// Make Carbon use app locale
		Carbon::setLocale(config('app.locale'));

		// Set up morph map for polymorphic relationships
		Relation::morphMap([
			'activity'           => 'Avem\Activity',
			'plain_transaction'  => 'Avem\PlainTransaction',
			'performed_activity' => 'Avem\PerformedActivity',
			'working_group'      => 'Avem\WorkingGroup',
		]);
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
