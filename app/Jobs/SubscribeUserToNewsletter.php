<?php

namespace Avem\Jobs;

use Log;
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

	private $user;

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
	public function handle()
	{
		$userFields = [
			'FNAME'  => $this->user->name,
			'LNAME'  => $this->user->surname,
			'NSOCIO' => $this->user->id,
		];

		Log::info('Subscribing user #'.$this->user->id.' to newsletter');

		if (!Newsletter::subscribe($this->user->email, $userFields)) {
			Log:error('Newsletter subscription failed for user #'.$this->user->id);
			
			throw new NewsletterError($this->user->email);
		}
	}
}
