<?php

namespace Avem\Providers;

use Avem\Activity;
use Avem\Charge;
use Avem\Destination;
use Avem\Exchange;
use Avem\MbMember;
use Avem\MbMemberPeriod;
use Avem\PerformedActivity;
use Avem\Renewal;
use Avem\User;
use Avem\WorkingGroup;

use Avem\Policies\ActivityPolicy;
use Avem\Policies\ChargePolicy;
use Avem\Policies\DestinationPolicy;
use Avem\Policies\ExchangePolicy;
use Avem\Policies\MbMemberPolicy;
use Avem\Policies\MbMemberPeriodPolicy;
use Avem\Policies\PerformedActivityPolicy;
use Avem\Policies\RenewalPolicy;
use Avem\Policies\UserPolicy;
use Avem\Policies\WorkingGroupPolicy;

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
		Activity::class          => ActivityPolicy::class,
		Charge::class            => ChargePolicy::class,
		Destination::class       => DestinationPolicy::class,
		Exchange::class          => ExchangePolicy::class,
		MbMember::class          => MbMemberPolicy::class,
		MbMemberPeriod::class    => MbMemberPeriodPolicy::class,
		PerformedActivity::class => PerformedTaskPolicy::class,
		Renewal::class           => RenewalPolicy::class,
		User::class              => UserPolicy::class,
		WorkingGroup::class      => WorkingGroupPolicy::class,
	];

	/**
	 * Register any authentication / authorization services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->registerPolicies();

		//
	}
}
