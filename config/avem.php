<?php

use Carbon\Carbon;

return [

	'period_start' => Carbon::createFromFormat('d/m', env('AVEM_PERIOD_START', '01/09')),

	'mailchimp' => [
		'member_list_id' => env('AVEM_MC_MEMBER_LIST_ID', ''),
	],
];
