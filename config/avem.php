<?php

use Carbon\Carbon;

return [

	'period_start' => Carbon::createFromFormat('d/m', env('AVEM_PERIOD_START', '1/9')),

	'mailchimp' => [
		'member_list_id' => env('AVEM_MC_MEMBER_LIST_ID', ''),
	],
];
