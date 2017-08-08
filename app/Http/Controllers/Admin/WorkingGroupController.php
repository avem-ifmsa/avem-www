<?php

namespace Avem\Http\Controllers\Admin;

use DB;
use Avem\WorkingGroup;
use Avem\ManagesTagsTrait;
use Illuminate\Http\Request;
use Avem\UsesWorkingGroupsTrait;
use Avem\Http\Controllers\Controller;

class WorkingGroupController extends Controller
{
	use ManagesTagsTrait;
	use UsesWorkingGroupsTrait;

	private function getWorkingGroups($except = null)
	{
		$allWorkingGroups = $this->prefetchWorkingGroups(WorkingGroup::all());
		$workingGroups = $allWorkingGroups->where('parent_group_id', null);
		if ($except)
			$workingGroups = $workingGroups->where('id', '<>', $except->id);
		return $workingGroups->sortByDesc(function($workingGroup) {
			return $workingGroup->subgroups->count();
		});
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->authorize('create', WorkingGroup::class);

		if ($parentGroup = $request->input('parentGroup'))
			Session::flash('_old_input.parent_group', $parentGroup);

		return view('admin.board.workingGroups.create', [
			'workingGroups' => $this->getWorkingGroups(),
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$this->authorize('create', WorkingGroup::class);

		DB::transaction(function() use ($request) {
			$workingGroup = new WorkingGroup($request->all());
			if ($parentGroup = $request->input('parent_group'))
				$workingGroup->parentGroup()->associate($parentGroup);
			$workingGroup->save();

			$groupTags = $this->inputTags($request, 'tags');
			$workingGroup->tags()->sync($groupTags);
		});

		return redirect()->route('admin.board');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \Avem\WorkingGroup  $workingGroup
	 * @return \Illuminate\Http\Response
	 */
	public function edit(WorkingGroup $workingGroup)
	{
		$this->authorize('update', $workingGroup);

		return view('admin.board.workingGroups.edit', [
			'workingGroup'  => $workingGroup,
			'workingGroups' => $this->getWorkingGroups($workingGroup),
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Avem\WorkingGroup  $workingGroup
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, WorkingGroup $workingGroup)
	{
		$this->authorize('update', $workingGroup);

		DB::transaction(function() use ($request, $workingGroup) {
			$workingGroup->fill($request->all());
			if ($parentGroup = $request->input('parent_group'))
				$workingGroup->parentGroup()->associate($parentGroup);
			$workingGroup->save();

			$groupTags = $this->inputTags($request, 'tags');
			$workingGroup->tags()->sync($groupTags);
		});

		return redirect()->route('admin.board');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \Avem\WorkingGroup  $workingGroup
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(WorkingGroup $workingGroup)
	{
		$this->authorize('remove', $workingGroup);

		$workingGroup->delete();

		return redirect()->route('admin.board');
	}
}
