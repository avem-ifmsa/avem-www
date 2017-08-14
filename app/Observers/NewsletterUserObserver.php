<?php

namespace Avem\Observers;

use Avem\User;
use Newsletter;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewsletterUserObserver implements ShouldQueue
{
	/**
	 * Listen to the User created event.
	 *
	 * @param  User  $user
	 * @return void
	 */
	public function created(User $user)
	{
		Newsletter::subscribe($user->email, [
			'FNAME'  => $user->name,
			'LNAME'  => $user->surname,
			'NSOCIO' => $user->id,
		]);
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
			Newsletter::updateEmailAddress($oldEmail, $newEmail);
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
		Newsletter::delete($user->email);
	}
}
