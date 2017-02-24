<?php

namespace Avem\Policies;

use Avem\User;
use Avem\WorkingGroup;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkingGroupPolicy
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view the workingGroup.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\WorkingGroup  $workingGroup
	 * @return mixed
	 */
	public function view(User $user, WorkingGroup $workingGroup)
	{
		return $user->hasPermission('working-group:view');
	}

	/**
	 * Determine whether the user can create workingGroups.
	 *
	 * @param  \Avem\User  $user
	 * @return mixed
	 */
	public function create(User $user)
	{
		return $user->hasPermission('working-group:create');
	}

	/**
	 * Determine whether the user can update the workingGroup.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\WorkingGroup  $workingGroup
	 * @return mixed
	 */
	public function update(User $user, WorkingGroup $workingGroup)
	{
		return $user->hasPermission('working-group:update');
	}

	/**
	 * Determine whether the user can delete the workingGroup.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\WorkingGroup  $workingGroup
	 * @return mixed
	 */
	public function delete(User $user, WorkingGroup $workingGroup)
	{
		return $user->hasPermission('working-group:delete');
	}
}
