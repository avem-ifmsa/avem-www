<?php

namespace Avem\Jobs;

use Avem\User;
use Newsletter;
use Illuminate\Bus\Queueable;
use Avem\Exceptions\NewsletterError;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SubscribeUserToNewsletter implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct(User $user)
	{
		$this->user = $user;
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle(Newsletter $newsletter)
	{
		$userFields = [
			'FNAME'  => $user->name,
			'LNAME'  => $user->surname,
			'NSOCIO' => $user->id,
		];
		
		if (!$newsletter->subscribe($this->user->email, $userFields))
			throw new NewsletterError($this->user->email);
	}
}
