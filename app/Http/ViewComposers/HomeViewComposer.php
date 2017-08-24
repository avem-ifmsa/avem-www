<?php

namespace Avem\Http\ViewComposers;

use Auth;
use Avem\User;
use Avem\Activity;
use Illuminate\View\View;

class HomeViewComposer
{
	/**
	 * Create a new profile composer.
	 *
	 * @return void
	 */
	public function __construct()
	{
	}

	/**
	 * Bind data to the view.
	 *
	 * @param  View  $view
	 * @return void
	 */
	public function compose(View $view)
	{
		$user = Auth::user();
		$inscribedActivities = $user->inscribedActivities()->upcoming()->get();
		$upcomingActivities = Activity::inscribableBy($user)
		                              ->whereNotIn('id', $inscribedActivities->pluck('id'))
		                              ->get();

		$view->with('upcomingActivities', $upcomingActivities);
		$view->with('inscribedActivities', $inscribedActivities);
	}
}
