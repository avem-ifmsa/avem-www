<?php

namespace Avem\Policies;

use Avem\User;
use Avem\MbMember;
use Illuminate\Auth\Access\HandlesAuthorization;

class MbMemberPolicy
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view the mbMember.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\MbMember  $mbMember
	 * @return mixed
	 */
	public function view(User $user, MbMember $mbMember)
	{
		return $user->id == $mbMember->user->id
		    || $user->hasPermission('mb-member:view');
	}

	/**
	 * Determine whether the user can create mbMembers.
	 *
	 * @param  \Avem\User  $user
	 * @return mixed
	 */
	public function create(User $user)
	{
		return $user->hasPermission('mb-member:create');
	}

	/**
	 * Determine whether the user can update the mbMember.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\MbMember  $mbMember
	 * @return mixed
	 */
	public function update(User $user, MbMember $mbMember)
	{
		return $user->hasPermission('mb-member:update');
	}

	/**
	 * Determine whether the user can delete the mbMember.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\MbMember  $mbMember
	 * @return mixed
	 */
	public function delete(User $user, MbMember $mbMember)
	{
		return $user->hasPermission('mb-member:delete');
	}
}
