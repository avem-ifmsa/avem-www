<?php

namespace Avem\Http\Controllers\Admin;

use Avem\ChargePeriod;
use Illuminate\Http\Request;
use Avem\Http\Controllers\Controller;

class ChargePeriodController extends Controller
{

	/**
	 * Display charge period actions.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Avem\ChargePeriod  $chargePeriod
	 * @return \Illuminate\Http\Response
	 */
	public function manage(Request $request, ChargePeriod $chargePeriod)
	{
		return view('admin.chargePeriods.manage', [
			'chargePeriod' => $chargePeriod->load('user', 'charge'),
		]);
	}

	/**
	 * Extend current period until next quarter.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Avem\ChargePeriod  $chargePeriod
	 * @return \Illuminate\Http\Response
	 */
	public function extendPeriod(Request $request, ChargePeriod $chargePeriod)
	{
		$this->authorize('update', $chargePeriod);

		$nextPeriodEnd = Carbon::create(null, 10, 1)->addYear();
		$chargePeriod->update([ 'end' => $nextPeriodEnd ]);

		return redirect()->route('admin.board');
	}

	/**
	 * End current period.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Avem\ChargePeriod  $chargePeriod
	 * @return \Illuminate\Http\Response
	 */
	public function finishPeriod(Request $request, ChargePeriod $chargePeriod)
	{
		$this->authorize('update', $chargePeriod);

		$chargePeriod->update([ 'end' => Carbon::now() ]);

		return redirect()->route('admin.board');
	}

}
