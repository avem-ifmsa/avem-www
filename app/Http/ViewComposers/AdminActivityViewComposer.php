<?php

namespace Avem\Http\ViewComposers;

use Avem\Activity;
use Illuminate\View\View;
use Illuminate\Http\Request;

class AdminActivityViewComposer
{
	private function filterActivities(Request $request, $query)
	{
		$filter = '%'.$request->input('q').'%';
		return $query->where('name', 'LIKE', $filter)
		             ->orWhere('description', 'LIKE', $filter);
	}

	private function getRequestedActivities(Request $request)
	{
		if ($filter = $request->input('q'))
			$matchingActivities = Activity::search($filter)->get();
		
		if ($request->input('organized_by', 'me') == 'me') {
			$chargePeriods = $request->user()->chargePeriods();
			$organizedActivities = $chargePeriods->join('activity_charge_period', 'charge_periods.id', '=', 'activity_charge_period.charge_period_id')
			                                     ->join('activities', 'activities.id', '=', 'activity_charge_period.activity_id');
			if (isset($matchingActivities))
				$organizedActivities = $organizedActivities->whereIn('activities.id', $matchingActivities->pluck('id'));
			$matchingActivities = $organizedActivities->select('activities.*')->get();
		}

		return isset($matchingActivities) ? $matchingActivities : Activity::all();
	}

	/**
	 * Create a new profile composer.
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
		$view->with('activities', $this->getRequestedActivities($this->request));
	}
}