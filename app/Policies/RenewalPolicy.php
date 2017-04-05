<?php

namespace Avem\Policies;

use Avem\User;
use Avem\Renewal;
use Illuminate\Auth\Access\HandlesAuthorization;

class RenewalPolicy
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view the renewal.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\Renewal  $renewal
	 * @return mixed
	 */
	public function view(User $user, Renewal $renewal)
	{
		return $user->can('view', $renewal->user);
	}

	/**
	 * Determine whether the user can create renewals.
	 *
	 * @param  \Avem\User  $user
	 * @return mixed
	 */
	public function create(User $user)
	{
		return $user->hasPermission('user:renew');
	}

	/**
	 * Determine whether the user can update the renewal.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\Renewal  $renewal
	 * @return mixed
	 */
	public function update(User $user, Renewal $renewal)
	{
		return $user->hasPermission('user:renew');
	}

	/**
	 * Determine whether the user can delete the renewal.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\Renewal  $renewal
	 * @return mixed
	 */
	public function delete(User $user, Renewal $renewal)
	{
		return $user->hasPermission('user:renew');
	}
}
