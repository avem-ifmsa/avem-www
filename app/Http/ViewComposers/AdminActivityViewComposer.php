<?php

namespace Avem\Http\ViewComposers;

use Avem\Activity;
use Illuminate\View\View;
use Illuminate\Http\Request;

class AdminActivityViewComposer
{
	private function getCurrentMbMemberPeriod(Request $request)
	{
		$mbMember = $request->user()->mbMember;
		$mbMemberPeriods = $mbMember ? $mbMember->mbMemberPeriods() : null;
		$activePeriod = $mbMemberPeriods ? $mbMemberPeriods->active()->first() : null;
		return $activePeriod;
	}

	private function getRequestedActivities(Request $request)
	{
		$organizedBy = $request->input('organized_by', 'me');
		if ($organizedBy == 'me') {
			$activePeriod = $this->getCurrentMbMemberPeriod($request);
			$activities = $activePeriod->organizedActivities();
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