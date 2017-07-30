<?php

namespace Avem\Http\ViewComposers;

use Avem\WorkingGroup;
use Illuminate\View\View;
use Avem\UsesWorkingGroupsTrait;

class AdminBoardViewComposer
{
	use UsesWorkingGroupsTrait;

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
		$workingGroups = $this->prefetchWorkingGroups(
			WorkingGroup::with('charges', 'charges.periods', 'charges.periods.user')->get()
		);

		$view->with('workingGroups', $workingGroups->where('parent_group_id', null));
	}
}
