<?php

namespace Avem\Policies;

use Avem\User;
use Avem\Activity;
use Avem\PerformedTask;
use Illuminate\Auth\Access\HandlesAuthorization;

class PerformedTaskPolicy
{
	use HandlesAuthorization;

	private function isActivityOrganizer(Activity $activity, User $user)
	{
		if (!$user->mbMember)
			return false;

		$organizedActivities = $user->mbMember->organizedActivities();
		return $organizedActivities()->where('id', $activity->id)->exists();
	}

	/**
	 * Determine whether the user can view the performedTask.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\PerformedTask  $performedTask
	 * @return mixed
	 */
	public function view(User $user, PerformedTask $performedTask)
	{
		$activity = $performedTask->activityTask->activity;
		return Gate::forUser($user)->allows('view', $activity);
	}

	/**
	 * Determine whether the user can create performedTasks.
	 *
	 * @param  \Avem\User  $user
	 * @return mixed
	 */
	public function create(User $user, Activity $activity)
	{
		return $this->isActivityOrganizer($activity, $user)
		    || $user->hasPermission('activity:update');
	}

	/**
	 * Determine whether the user can update the performedTask.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\PerformedTask  $performedTask
	 * @return mixed
	 */
	public function update(User $user, PerformedTask $performedTask)
	{
		$activity = $performedTask->activityTask->activity;
		return Gate::forUser($user)->allows('update', $activity);
	}

	/**
	 * Determine whether the user can delete the performedTask.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\PerformedTask  $performedTask
	 * @return mixed
	 */
	public function delete(User $user, PerformedTask $performedTask)
	{
		$activity = $performedTask->activityTask->activity;
		return Gate::forUser($user)->allows('delete', $activity);
	}
}
