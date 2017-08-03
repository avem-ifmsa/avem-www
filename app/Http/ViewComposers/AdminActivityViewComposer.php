<?php

namespace Avem\Http\ViewComposers;

use Avem\User;
use Avem\Activity;
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
		$view->with('allActivities', Activity::all());

		if ($user = $this->request->user()) {
			$view->with('organizedActivities', $this->organizedActivities($user));
		} else {
			$view->with('organizedActivities', collect([]));
		}
	}
}
