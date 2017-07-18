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
		$job = new SubscribeUserToNewsletter($user);
		dispatch($job->onQueue('newsletter'));
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
			$job = new UpdateUserNewsletterEmail($user, $oldEmail);
			dispatch($job->onQueue('newsletter'));
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
		$job = new UnsubscribeUserFromNewsletter($user);
		dispatch($job->onQueue('newsletter'));
	}
}