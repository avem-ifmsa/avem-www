<?php

namespace Avem;

use Avem\WorkingGroup;

trait UsesWorkingGroupsTrait
{
	function prefetchWorkingGroups($workingGroups)
	{
		foreach ($workingGroups as $parentGroup) {
			$parentGroup->subgroups = $workingGroups->where('parent_group_id', $parentGroup->id);
			foreach ($parentGroup->subgroups as $childGroup)
				$childGroup->parentGroup = $parentGroup;
		}
		return $workingGroups;
	}
}
