<?php

namespace Avem\Observers;

use Avem\User;
use Avem\Jobs\SubscribeUserToNewsletter;
use Avem\Jobs\UpdateUserNewsletterEmail;
use Avem\Jobs\UnsubscribeUserFromNewsletter;

class NewsletterUserObserver
{
	/**
	 * Listen to the User created event.
	 *
	 * @param  User  $user
	 * @return void
	 */
	public function created(User $user)
	{
		dispatch(new SubscribeUserToNewsletter($user));
	}

	/**
	 * Listen to the User updating event.
	 *
	 * @param  User  $user
	 * @return void
	 */
	public function updating(User $user)
	{
		if ($user->isDirty('email')) {
			$newEmail = $user->email;
			$oldEmail = $user->getOriginal('email');
			dispatch(new UpdateUserNewsletterEmail($user, $oldEmail));
		}
	}

	/**
	 * Listen to the User deleting event.
	 *
	 * @param  User  $user
	 * @return void
	 */
	public function deleting(User $user)
	{
		dispatch(new UnsubscribeUserFromNewsletter($user));
	}
}
