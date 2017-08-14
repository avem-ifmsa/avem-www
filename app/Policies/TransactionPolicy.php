<?php

namespace Avem\Policies;

use Avem\User;
use Avem\Transaction;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionPolicy
{
	use HandlesAuthorization;

	private function isTransactionApplier(Transaction $transaction, User $user)
	{
		return $transaction->applierPeriod->user->id === $user->id;
	}

	/**
	 * Determine whether the user can view the activity.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\Transaction  $transaction
	 * @return mixed
	 */
	public function view(User $user, Transaction $transaction)
	{
		return $this->isTransactionApplier($transaction, $user)
		    || $user->hasPermission('transaction:view');
	}

	/**
	 * Determine whether the user can create activities.
	 *
	 * @param  \Avem\User  $user
	 * @return mixed
	 */
	public function create(User $user)
	{
		return $user->hasPermission('transaction:create');
	}

	/**
	 * Determine whether the user can update the activity.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\Transaction  $transaction
	 * @return mixed
	 */
	public function update(User $user, Transaction $transaction)
	{
		return $this->isTransactionApplier($transaction, $user)
		    || $user->hasPermission('transaction:update');
	}

	/**
	 * Determine whether the user can delete the activity.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\Transaction  $transaction
	 * @return mixed
	 */
	public function delete(User $user, Transaction $transaction)
	{
		return $this->isTransactionApplier($transaction, $user)
		    || $user->hasPermission('transaction:delete');
	}
}
