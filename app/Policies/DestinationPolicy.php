<?php

namespace Avem\Policies;

use Avem\User;
use Avem\Destination;
use Illuminate\Auth\Access\HandlesAuthorization;

class DestinationPolicy
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view the destination.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\Destination  $destination
	 * @return mixed
	 */
	public function view(User $user, Destination $destination)
	{
		return $user->hasPermission('exchange:view');
	}

	/**
	 * Determine whether the user can create destinations.
	 *
	 * @param  \Avem\User  $user
	 * @return mixed
	 */
	public function create(User $user)
	{
		return $user->hasPermission('exchange:create');
	}

	/**
	 * Determine whether the user can update the destination.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\Destination  $destination
	 * @return mixed
	 */
	public function update(User $user, Destination $destination)
	{
		return $user->hasPermission('exchange:update');
	}

	/**
	 * Determine whether the user can delete the destination.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\Destination  $destination
	 * @return mixed
	 */
	public function delete(User $user, Destination $destination)
	{
		return $user->hasPermission('exchange:delete');
	}
}
