<?php

namespace Avem\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

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
		setlocale(LC_TIME, 'es_ES.utf-8');
		Carbon::setLocale(config('app.locale'));

		// Set up morph map for polymorphic relationships
		Relation::morphMap([
			'activity'           => 'Avem\Activity',
			'charge'             => 'Avem\Charge',
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
