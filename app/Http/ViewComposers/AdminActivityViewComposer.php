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
		$organizedBy = $request->input('organized_by', 'me');
		if ($organizedBy == 'me') {
			$chargePeriods = $request->user()->chargePeriods();
			$activities = $chargePeriods->join('activities', 'charge_period_id', '=', 'charge_periods.id')
			                            ->select('activities.*');
		} else {
			$activities = Activity::query();
		}

		if ($request->has('q')) {
			$activities = $this->filterActivities($request, $activities);
		}

		return $activities->get();
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