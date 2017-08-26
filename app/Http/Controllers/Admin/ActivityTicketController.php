<?php

namespace Avem\Http\Controllers\Admin;

use PDF;
use Carbon\Carbon;
use Avem\Activity;
use Avem\ActivityTicket;
use Illuminate\Http\Request;
use Avem\Http\Controllers\Controller;
use Avem\Jobs\GenerateActivityTickets;

class ActivityTicketController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @param  \Avem\Activity $activity
	 * @return \Illuminate\Http\Response
	 */
	public function index(Activity $activity)
	{
		$this->authorize('view', $activity);

		$activity->load(
			'activityTickets', 'activityTickets.issuerPeriod',
			'activityTickets.issuerPeriod.user'
		);

		return view('admin.activities.tickets.index', [
			'activity' => $activity,
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param  \Avem\Activity $activity
	 * @return \Illuminate\Http\Response
	 */
	public function create(Activity $activity)
	{
		$this->authorize('update', $activity);

		return view('admin.activities.tickets.create', [
			'activity' => $activity,
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Avem\Activity  $activity
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Activity $activity, Request $request)
	{
		$this->authorize('update', $activity);

		$count = $request->input('count');
		$expiresAt = $request->input('expires_at');
		$this->dispatch(new GenerateActivityTickets($activity, $count, $expiresAt));

		if (config('queue.default') === 'sync') {
			return redirect()->route('admin.activities.tickets.index', [$activity]);
		} else {
			return view('admin.activities.tickets.creating', [
				'activity' => $activity,
			]);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \Avem\Activity  $activity
	 * @param  \Avem\ActivityTicket  $ticket
	 * @return \Illuminate\Http\Response
	 */
	public function show(Activity $activity, ActivityTicket $ticket)
	{
		$this->authorize('view', $ticket);

		$pdf = PDF::loadView('pdf.tickets', [
			'activity' => $activity,
			'activityTickets' => ActivityTicket::fromTicketLot($ticket)
			                                   ->exchanged(false)
			                                   ->orderBy('id')
			                                   ->get(),
		]);

		return $pdf->stream($activity->name.' - Tickets.pdf');
	}

	/**
	 * Shows expire tickets confirm dialog.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Avem\Activity  $activity
	 * @param  \Avem\ActivityTicket  $ticket
	 * @return \Illuminate\Http\Response
	 */
	public function confirmExpire(Request $request, Activity $activity, ActivityTicket $ticket)
	{
		$this->authorize('update', $ticket);

		return view('admin.activities.tickets.expire', [
			'activity'        => $activity,
			'activityTickets' => ActivityTicket::fromTicketLot($ticket)->get(),
		]);
	}

	/**
	 * Expires an activity ticket lot.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Avem\Activity  $activity
	 * @param  \Avem\ActivityTicket  $ticket
	 * @return \Illuminate\Http\Response
	 */
	public function expire(Request $request, Activity $activity, ActivityTicket $ticket)
	{
		$this->authorize('update', $ticket);

		$now = Carbon::now();
		ActivityTicket::fromTicketLot($ticket)->update([
			'expires_at' => $now, 'updated_at' => $now,
		]);

		return redirect()->route('admin.activities.tickets.index', [$activity]);
	}
}
