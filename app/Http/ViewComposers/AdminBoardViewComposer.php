<?php

namespace Avem\Http\ViewComposers;

use Avem\WorkingGroup;
use Illuminate\View\View;

class AdminBoardViewComposer
{
	/**
	 * Create a new profile composer.
	 *
	 * @return void
	 */
	public function __construct()
	{
	}

	private function prefetchWorkingGroups($workingGroups)
	{
		foreach ($workingGroups as $parentGroup) {
			$parentGroup->subgroups = $workingGroups->where('parent_group_id', $parentGroup->id);
			foreach ($parentGroup->subgroups as $childGroup)
				$childGroup->parentGroup = $parentGroup;
		}
		return $workingGroups;
	}

	/**
	 * Bind data to the view.
	 *
	 * @param  View  $view
	 * @return void
	 */
	public function compose(View $view)
	{
		$workingGroups = WorkingGroup::with('charges', 'charges.periods', 'charges.periods.user')->get();
		$workingGroups = $this->prefetchWorkingGroups($workingGroups);

		$view->with('workingGroups', $workingGroups->where('parent_group_id', null));
	}
}