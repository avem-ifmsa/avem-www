<?php

namespace Avem\Policies;

use Avem\User;
use Avem\Activity;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActivityPolicy
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
	 * Determine whether the user can view the activity.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\Activity  $activity
	 * @return mixed
	 */
	public function view(User $user, Activity $activity)
	{
		return $this->isActivityOrganizer($activity, $user))
		    || $user->hasPermission('activity:view');
	}

	/**
	 * Determine whether the user can create activities.
	 *
	 * @param  \Avem\User  $user
	 * @return mixed
	 */
	public function create(User $user)
	{
		return $user->hasPermission('activity:create');
	}

	/**
	 * Determine whether the user can update the activity.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\Activity  $activity
	 * @return mixed
	 */
	public function update(User $user, Activity $activity)
	{
		return $this->isActivityOrganizer($activity, $user))
		    || $user->hasPermission('activity:update');
	}

	/**
	 * Determine whether the user can delete the activity.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\Activity  $activity
	 * @return mixed
	 */
	public function delete(User $user, Activity $activity)
	{
		return $this->isActivityOrganizer($activity, $user))
		    || $user->hasPermission('activity:delete');
	}
}
