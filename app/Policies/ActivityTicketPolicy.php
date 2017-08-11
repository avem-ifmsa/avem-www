<?php

namespace Avem\Policies;

use Avem\User;
use Avem\ActivityTicket;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActivityTicketPolicy
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view the activity ticket.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\ActivityTicket  $activityTicket
	 * @return mixed
	 */
	public function view(User $user, ActivityTicket $activityTicket)
	{
		return $user->can('view', $activityTicket->activity);
	}

	/**
	 * Determine whether the user can create activity tickets.
	 *
	 * @param  \Avem\User  $user
	 * @return mixed
	 */
	public function create(User $user)
	{
		return false;
	}

	/**
	 * Determine whether the user can update the activity ticket.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\ActivityTicket  $activityTicket
	 * @return mixed
	 */
	public function update(User $user, ActivityTicket $activityTicket)
	{
		return $user->can('update', $activityTicket->activity);
	}

	/**
	 * Determine whether the user can delete the activity ticket.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\ActivityTicket  $activityTicket
	 * @return mixed
	 */
	public function delete(User $user, ActivityTicket $activityTicket)
	{
		return $user->can('update', $activityTicket->activity);
	}
}
