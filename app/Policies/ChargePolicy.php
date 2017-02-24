<?php

namespace Avem\Policies;

use Avem\User;
use Avem\Charge;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChargePolicy
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view the charge.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\Charge  $charge
	 * @return mixed
	 */
	public function view(User $user, Charge $charge)
	{
		return $user->hasPermission('charge:view');
	}

	/**
	 * Determine whether the user can create charges.
	 *
	 * @param  \Avem\User  $user
	 * @return mixed
	 */
	public function create(User $user)
	{
		return $user->hasPermission('charge:create');
	}

	/**
	 * Determine whether the user can update the charge.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\Charge  $charge
	 * @return mixed
	 */
	public function update(User $user, Charge $charge)
	{
		return $user->hasPermission('charge:update');
	}

	/**
	 * Determine whether the user can delete the charge.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\Charge  $charge
	 * @return mixed
	 */
	public function delete(User $user, Charge $charge)
	{
		return $user->hasPermission('charge:delete');
	}
}
