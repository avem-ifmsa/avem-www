<?php

use Carbon\Carbon;

return [

	'period_start' => Carbon::createFromFormat('d/m', env('AVEM_PERIOD_START', '1/9')),

];
