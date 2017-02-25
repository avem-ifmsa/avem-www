<?php

namespace Avem\Http\Controllers\Admin;

use Auth;
use Avem\Activity;
use Avem\MbMemberPeriod;
use Illuminate\Http\Request;
use Avem\Http\Controllers\Controller;

class ActivityController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$mbMember = Auth::user()->mbMember;
		$organizedActivities = $mbMember ? $mbMember->organizedActivities() : collect([]);
		$otherActivities = Activity::whereNotIn('id', $organizedActivities->pluck('id'))->get();
		return view('admin.activities.index', compact('organizedActivities', 'otherActivities'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$mbMember = Auth::user()->mbMember;
		return view('admin.activities.create', [
			'mbMemberPeriods'  => MbMemberPeriod::active(),
			'organizerPeriods' => collect($mbMember
				? [$mbMember->mbMemberPeriods->active()->first()]
				: []
			),
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
		return view('admin.activities.show', [
			'activity'      => $activity,
			'activityTasks' => $activity->activityTasks,
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
		$activity->update($request->all());
		$activity->organizerPeriods()->sync($request->input('organizers', []));
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
		$activity->delete();
		return redirect()->route('admin.activities.index');
	}
}
