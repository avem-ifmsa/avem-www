<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Stripe, Mailgun, SparkPost and others. This file provides a sane
	| default location for this type of information, allowing packages
	| to have a conventional place to find your various credentials.
	|
	*/

	'facebook' => [
		'client_id' => env('FACEBOOK_CLIENT_ID'),
		'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
		'redirect' => 'http://avem.es.local/auth/facebook/callback',
	],

	'google' => [
		'client_id' => env('GOOGLE_CLIENT_ID'),
		'client_secret' => env('GOOGLE_CLIENT_SECRET'),
		'redirect' => 'http://avem.es.local/auth/google/callback',
	],

	'mailchimp' => [
		'api_key' => env('MAILCHIMP_API_KEY'),
		'list_id' => env('MAILCHIMP_LIST_ID'),
	],

	'mailgun' => [
		'domain' => env('MAILGUN_DOMAIN'),
		'secret' => env('MAILGUN_SECRET'),
	],

	'ses' => [
		'key' => env('SES_KEY'),
		'secret' => env('SES_SECRET'),
		'region' => 'us-east-1',
	],

	'sparkpost' => [
		'secret' => env('SPARKPOST_SECRET'),
	],

	'stripe' => [
		'model' => Avem\User::class,
		'key' => env('STRIPE_KEY'),
		'secret' => env('STRIPE_SECRET'),
	],

	'twitter' => [
		'client_id' => env('TWITTER_CLIENT_ID'),
		'client_secret' => env('TWITTER_CLIENT_SECRET'),
		'redirect' => 'http://avem.es.local/auth/twitter/callback',
	],

];
