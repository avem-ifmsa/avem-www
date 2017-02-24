<?php

namespace Avem\Policies;

use Avem\User;
use Avem\ActivityTask;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActivityTaskPolicy
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view the activityTask.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\ActivityTask  $activityTask
	 * @return mixed
	 */
	public function view(User $user, ActivityTask $activityTask)
	{
		return Gate::forUser($user)->allows('view', $activityTask->activity);
	}

	/**
	 * Determine whether the user can create activityTasks.
	 *
	 * @param  \Avem\User  $user
	 * @return mixed
	 */
	public function create(User $user)
	{
		return Gate::forUser($user)->allows('create', Activity::class);
	}

	/**
	 * Determine whether the user can update the activityTask.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\ActivityTask  $activityTask
	 * @return mixed
	 */
	public function update(User $user, ActivityTask $activityTask)
	{
		return Gate::forUser($user)->allows('update', $activityTask->activity);
	}

	/**
	 * Determine whether the user can delete the activityTask.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\ActivityTask  $activityTask
	 * @return mixed
	 */
	public function delete(User $user, ActivityTask $activityTask)
	{
		return Gate::forUser($user)->allows('delete', $activityTask->activity);
	}
}
