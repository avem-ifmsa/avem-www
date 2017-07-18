<?php

use Exception;

class NewsletterError extends Exception
{

	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct($email)
	{
		$this->email = $email;
	}
};