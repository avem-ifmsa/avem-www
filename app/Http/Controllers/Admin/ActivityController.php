<?php

namespace Avem\Http\Controllers\Admin;

use Auth;
use Avem\Activity;
use Avem\MbMemberPeriod;
use Illuminate\Http\Request;
use Avem\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class ActivityController extends Controller
{
	private function getCurrentMbMemberPeriod(Request $request)
	{
		$mbMember = $request->user()->mbMember;
		$mbMemberPeriods = $mbMember ? $mbMember->mbMemberPeriods() : null;
		$activePeriod = $mbMemberPeriods ? $mbMemberPeriods->active()->first() : null;
		return $activePeriod;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		return view('admin.activities.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(Request $request)
	{
		$this->authorize('create', Activity::class);

		$activePeriod = $this->getCurrentMbMemberPeriod($request);
		return view('admin.activities.create', [
			'mbMemberPeriods'  => MbMemberPeriod::active(),
			'organizerPeriods' => $activePeriod ? [$activePeriod] : [],
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$this->authorize('create', Activity::class);

		$activity = Activity::create($request->all());
		$activity->organizerPeriods()->sync($request->input('organizers', []));
		return redirect()->route('admin.activities.show', [$activity]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \Avem\Activity  $activity
	 * @return \Illuminate\Http\Response
	 */
	public function show(Activity $activity)
	{
		$this->authorize('view', $activity);

		return view('admin.activities.show', [
			'activity' => $activity,
		]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \Avem\Activity  $activity
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Activity $activity)
	{
		$this->authorize('update', $activity);

		return view('admin.activities.edit', [
			'activity'         => $activity,
			'mbMemberPeriods'  => MbMemberPeriod::active(),
			'organizerPeriods' => $activity->organizerPeriods(),
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Avem\Activity  $activity
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Activity $activity)
	{
		$this->authorize('update', $activity);

		$activity->update($request->all());
		$activity->organizerPeriods()->sync($request->input('organizer_periods', []));
		return redirect()->route('admin.activities.show', [$activity]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \Avem\Activity  $activity
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Activity $activity)
	{
		$this->authorize('delete', $activity);

		$activity->delete();
		return redirect()->route('admin.activities.index');
	}
}
