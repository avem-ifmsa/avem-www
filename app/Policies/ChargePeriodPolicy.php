<?php

namespace Avem\Policies;

use Avem\User;
use Avem\ChargePeriod;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChargePeriodPolicy
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view the chargePeriod.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\ChargePeriod  $chargePeriod
	 * @return mixed
	 */
	public function view(User $user, ChargePeriod $chargePeriod)
	{
		return $user->can('view', $chargePeriod->user);
	}

	/**
	 * Determine whether the user can create chargePeriods.
	 *
	 * @param  \Avem\User  $user
	 * @return mixed
	 */
	public function create(User $user)
	{
		return $user->hasPermission('charge:renew');
	}

	/**
	 * Determine whether the user can update the chargePeriod.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\ChargePeriod  $chargePeriod
	 * @return mixed
	 */
	public function update(User $user, ChargePeriod $chargePeriod)
	{
		return $user->hasPermission('charge:renew');
	}

	/**
	 * Determine whether the user can delete the chargePeriod.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\ChargePeriod  $chargePeriod
	 * @return mixed
	 */
	public function delete(User $user, ChargePeriod $chargePeriod)
	{
		return $user->hasPermission('charge:renew');
	}
}
