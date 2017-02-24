<?php

namespace Avem\Policies;

use Avem\User;
use Avem\Exchange;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExchangePolicy
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view the exchange.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\Exchange  $exchange
	 * @return mixed
	 */
	public function view(User $user, Exchange $exchange)
	{
		return $user->hasPermission('exchange:view');
	}

	/**
	 * Determine whether the user can create exchanges.
	 *
	 * @param  \Avem\User  $user
	 * @return mixed
	 */
	public function create(User $user)
	{
		return $user->hasPermission('exchange:create');
	}

	/**
	 * Determine whether the user can update the exchange.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\Exchange  $exchange
	 * @return mixed
	 */
	public function update(User $user, Exchange $exchange)
	{
		return $user->hasPermission('exchange:update');
	}

	/**
	 * Determine whether the user can delete the exchange.
	 *
	 * @param  \Avem\User  $user
	 * @param  \Avem\Exchange  $exchange
	 * @return mixed
	 */
	public function delete(User $user, Exchange $exchange)
	{
		return $user->hasPermission('exchange:delete');
	}
}
