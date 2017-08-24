<?php

namespace Avem\Http\Controllers\Admin;

use DB;
use Auth;
use Session;
use Avem\Activity;
use Avem\ChargePeriod;
use Avem\ManagesTagsTrait;
use Illuminate\Http\Request;
use Avem\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class ActivityController extends Controller
{
	use ManagesTagsTrait;

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

		$currentPeriod = $request->user()->currentChargePeriod;
		if ($currentPeriod != null) {
			$charge = $currentPeriod->charge;
			$tags = $charge->tags->pluck('name');
			Session::flash('_old_input.tags', $tags->implode(','));
		}

		return view('admin.activities.create', [
			'organizerPeriods' => collect($currentPeriod ? [$currentPeriod] : []),
			'chargePeriods'    => ChargePeriod::active()->with('charge', 'user')
			                                  ->get()->sortBy('charge.id'),
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

		DB::transaction(function() use ($request) {
			$activity = Activity::create($request->all());

			$activity->organizerPeriods()->sync(
				$request->input('organizer_periods', [])
			);

			if ($request->hasFile('image')) {
				$activity->addMediaFromRequest('image')
				         ->toMediaLibrary('images');
			}

			$activityTags = $this->inputTags($request, 'tags');
			$activity->tags()->sync($activityTags->pluck('id'));
		});

		return redirect()->route('admin.activities.index');
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
			'organizerPeriods' => $activity->organizerPeriods,
			'chargePeriods'    => $activity->organizerPeriods->merge(
				ChargePeriod::active()->with('charge', 'user')
				                      ->get()->sortBy('charge.id')
			),
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

		DB::transaction(function() use ($request, $activity) {
			$activity->update($request->all());

			$activity->organizerPeriods()->sync(
				$request->input('organizer_periods', [])
			);

			if ($request->hasFile('image')) {
				$activity->clearMediaCollection('images');
				$activity->addMediaFromRequest('image')
				         ->toMediaLibrary('images');
			}

			$activityTags = $this->inputTags($request, 'tags');
			$activity->tags()->sync($activityTags->pluck('id'));
		});

		return redirect()->route('admin.activities.index');
	}

	public function publish(Request $request, Activity $activity)
	{
		$this->authorize('update', $activity);

		$activity->update([
			'published' => $request->input('published', false)
		]);

		return redirect()->back();
	}

	public function confirmDelete(Activity $activity)
	{
		$this->authorize('delete', $activity);

		return view('admin.activities.delete', [
			'activity' => $activity,
		]);
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
