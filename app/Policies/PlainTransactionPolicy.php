<?php

namespace Avem\Policies;

use Avem\User;
use Avem\PlainTransaction;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlainTransactionPolicy
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view the plainTransaction.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\PlainTransaction  $plainTransaction
	 * @return mixed
	 */
	public function view(User $user, PlainTransaction $plainTransaction)
	{
		return $user->hasPermission('transaction:view');
	}

	/**
	 * Determine whether the user can create plainTransactions.
	 *
	 * @param  \Avem\User  $user
	 * @return mixed
	 */
	public function create(User $user)
	{
		return $user->hasPermission('transaction:create');
	}

	/**
	 * Determine whether the user can update the plainTransaction.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\PlainTransaction  $plainTransaction
	 * @return mixed
	 */
	public function update(User $user, PlainTransaction $plainTransaction)
	{
		return $user->hasPermission('transaction:update');
	}

	/**
	 * Determine whether the user can delete the plainTransaction.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\PlainTransaction  $plainTransaction
	 * @return mixed
	 */
	public function delete(User $user, PlainTransaction $plainTransaction)
	{
		return $user->hasPermission('transaction:delete');
	}
}
