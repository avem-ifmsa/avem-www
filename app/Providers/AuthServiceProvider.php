<?php

namespace Avem\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
	/**
	 * The policy mappings for the application.
	 *
	 * @var array
	 */
	protected $policies = [
		'Avem\Activity' => 'Avem\Policies\ActivityPolicy',
		'Avem\ActivityTicket' => 'Avem\Policies\ActivityTicketPolicy',
		'Avem\Charge' => 'Avem\Policies\ChargePolicy',
		'Avem\ChargePeriod' => 'Avem\Policies\ChargePeriodPolicy',
		'Avem\Exchange' => 'Avem\Policies\ExchangePolicy',
		'Avem\PerformedActivity' => 'Avem\Policies\PerformedActivityPolicy',
		'Avem\Renewal' => 'Avem\Policies\RenewalPolicy',
		'Avem\Transaction' => 'Avem\Policies\TransactionPolicy',
		'Avem\User' => 'Avem\Policies\UserPolicy',
		'Avem\WorkingGroup' => 'Avem\Policies\WorkingGroupPolicy',
	];

	/**
	 * Register any authentication / authorization services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->registerPolicies();

		Passport::routes();
	}
}
