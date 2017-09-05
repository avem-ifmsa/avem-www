<?php

namespace Avem\Http\ViewComposers;

use Avem\User;
use Avem\Activity;
use Carbon\Carbon;
use Illuminate\View\View;
use Illuminate\Http\Request;

class AdminActivityViewComposer
{
	/**
	 * Get activities organized by given user.
	 *
	 * @param  User  $user
	 * @return Avem\Activity
	 */
	private function organizedActivities(User $user)
	{
		$user->load('chargePeriods', 'chargePeriods.organizedActivities');
		return $user->chargePeriods->reduce(function($activities, $period) {
			return $activities->merge(
				$period->organizedActivities->filter(function($a) use ($activities) {
					return !$activities->contains('id', $a->id);
				})
			);
		}, collect([]));
	}

	private function sortActivities($activities)
	{
		$byCreation = $activities->where('start', null);
		$byProximity = $activities->where('start', '!=', null);

		$now = Carbon::now();
		$proximity = function($activity) use ($now) {
			return $activity->start->diffInDays($now);
		};

		$byCreation->sortByDesc('created_at');
		$passed = $byProximity->filter(function ($activity) use ($now) {
			return $activity->start->lt($now);
		})->sortBy($proximity);
		$pending = $byProximity->filter(function ($activity) use ($now) {
			return $activity->start->gte($now);
		})->sortBy($proximity);

		$result = array_collapse([$pending, $passed, $byCreation]);
		return collect($result);
	}

	/**
	 * Create a new admin activity view composer.
	 *
	 * @return void
	 */
	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	/**
	 * Bind data to the view.
	 *
	 * @param  View  $view
	 * @return void
	 */
	public function compose(View $view)
	{
		if ($filter = $this->request->input('q')) {
			$allActivities = Activity::search($filter)->get();
			$view->with('q', $filter);
		} else {
			$allActivities = Activity::all();
		}

		if ($user = $this->request->user()) {
			$organizedActivities = $this->organizedActivities($user);
		} else {
			$organizedActivities = collect([]);
		}

		$now = Carbon::now();
		$activityProximity = function($activity) use ($now) {
			if ($activity->start != null && $activity->start->gte($now))
				return $activity->start->diffInDays($now);
			else
				return $activity->created_at->diffInDays($now);
		};

		$view->with('allActivities', $this->sortActivities($allActivities));
		$view->with('organizedActivities', $this->sortActivities($organizedActivities));
	}
}
