<?php

namespace Avem\Policies;

use Avem\User;
use Avem\Activity;
use Avem\PerformedActivity;
use Illuminate\Auth\Access\HandlesAuthorization;

class PerformedActivityPolicy
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
	 * Determine whether the user can view the performedActivity.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\PerformedActivity  $performedActivity
	 * @return mixed
	 */
	public function view(User $user, PerformedActivity $performedActivity)
	{
		$activity = $performedActivity->activity;
		return Gate::forUser($user)->allows('view', $activity);
	}

	/**
	 * Determine whether the user can create performedActivitys.
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
	 * Determine whether the user can update the performedActivity.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\PerformedActivity  $performedActivity
	 * @return mixed
	 */
	public function update(User $user, PerformedActivity $performedActivity)
	{
		$activity = $performedActivity->activityTask->activity;
		return Gate::forUser($user)->allows('update', $activity);
	}

	/**
	 * Determine whether the user can delete the performedActivity.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\PerformedActivity  $performedActivity
	 * @return mixed
	 */
	public function delete(User $user, PerformedActivity $performedActivity)
	{
		$activity = $performedActivity->activityTask->activity;
		return Gate::forUser($user)->allows('delete', $activity);
	}
}
