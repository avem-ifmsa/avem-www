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

class UpdateUserNewsletterEmail implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	private $user;
	private $oldEmail;

	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, $oldEmail)
	{
		$this->user = $user;
		$this->oldEmail = $oldEmail;
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle()
	{
		Log::info('Updating newsletter subscription for user #'.$this->user->id);

		if (Newsletter::isSubscribed($this->oldEmail)) {
			if (!Newsletter::updateEmailAddress($this->oldEmail, $this->user->email)) {
				Log::error('Newsletter subscription update failed for user #'.$this->user->id);

				throw new NewsletterError($this->oldEmail);
			}
		}
	}
}
