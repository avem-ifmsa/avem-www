<?php

use Carbon\Carbon;

return [

	'period_start' => Carbon::createFromFormat('d/m', '01/09'),

	'mailchimp' => [
		'member_list_id' => env('MAILCHIMP_MEMBER_LIST_ID'),
	],

];
