<?php

namespace Avem\Http\Controllers\Admin;

use Avem\User;
use Avem\Charge;
use Carbon\Carbon;
use Avem\ChargePeriod;
use Illuminate\Http\Request;
use Avem\Http\Controllers\Controller;

class ChargePeriodController extends Controller
{
	/**
	 * Show the form for creating a new resource.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$this->authorize('create', ChargePeriod::class);

		$chargePeriod = new ChargePeriod;
		$chargePeriod->start = Carbon::now();
		$chargePeriod->end = $request->input('end');

		$chargeUser = User::findOrFail($request->input('user'));
		$chargePeriod->user()->associate($chargeUser);

		$periodCharge = Charge::findOrFail($request->input('charge'));
		$chargePeriod->charge()->associate($periodCharge);

		$chargePeriod->save();

		return redirect()->route('admin.board');
	}

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

		$nextPeriodEnd = Carbon::create(null, 9, 1)->addYear();
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
