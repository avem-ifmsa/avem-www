<?php

namespace Avem\Policies;

use Avem\User;
use Avem\Renewal;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view the user.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\User  $viewedUser
	 * @return mixed
	 */
	public function view(User $user, User $viewedUser)
	{
		return $user->id == $viewedUser->id
		    || $user->hasPermission('user:view');
	}

	/**
	 * Determine whether the user can create users.
	 *
	 * @param  \Avem\User  $user
	 * @return mixed
	 */
	public function create(User $user)
	{
		return $user->hasPermission('user:create');
	}

	/**
	 * Determine whether the user can update the user.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\User  $updatedUser
	 * @return mixed
	 */
	public function update(User $user, User $updatedUser)
	{
		return $user->hasPermission('user:update');
	}

	public function renew(User $user, User $renewedUser)
	{
		return $user->can('create', Renewal::class);
	}

	/**
	 * Determine whether the user can delete the user.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\User  $deletedUser
	 * @return mixed
	 */
	public function delete(User $user, User $deletedUser)
	{
		return $user->id == $deletedUser->id
		    || $user->hasPermission('user:delete');
	}
}
