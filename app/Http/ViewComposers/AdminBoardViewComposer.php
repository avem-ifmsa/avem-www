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

	/**
	 * Bind data to the view.
	 *
	 * @param  View  $view
	 * @return void
	 */
	public function compose(View $view)
	{
		$workingGroups = WorkingGroup::with('charges', 'charges.periods', 'charges.periods.user')->get();
		foreach ($workingGroups as $parentGroup) {
			$parentGroup->subgroups = $workingGroups->where('parent_group_id', $parentGroup->id);
			foreach ($parentGroup->subgroups as $subgroup)
				$subgroup->parentGroup = $parentGroup;
		}

		$view->with('workingGroups', $workingGroups->where('parent_group_id', null));
	}
}