<?php

namespace Avem\Policies;

use Avem\User;
use Avem\MbMemberPeriod;
use Illuminate\Auth\Access\HandlesAuthorization;

class MbMemberPeriodPolicy
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view the mbMemberPeriod.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\MbMemberPeriod  $mbMemberPeriod
	 * @return mixed
	 */
	public function view(User $user, MbMemberPeriod $mbMemberPeriod)
	{
		return Gate::forUser($user)->allows('view', $mbMemberPeriod->mbMember);
	}

	/**
	 * Determine whether the user can create mbMemberPeriods.
	 *
	 * @param  \Avem\User  $user
	 * @return mixed
	 */
	public function create(User $user)
	{
		return $user->hasPermission('mb-member:renew');
	}

	/**
	 * Determine whether the user can update the mbMemberPeriod.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\MbMemberPeriod  $mbMemberPeriod
	 * @return mixed
	 */
	public function update(User $user, MbMemberPeriod $mbMemberPeriod)
	{
		return $user->hasPermission('mb-member:renew');
	}

	/**
	 * Determine whether the user can delete the mbMemberPeriod.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\MbMemberPeriod  $mbMemberPeriod
	 * @return mixed
	 */
	public function delete(User $user, MbMemberPeriod $mbMemberPeriod)
	{
		return $user->hasPermission('mb-member:renew');
	}
}
