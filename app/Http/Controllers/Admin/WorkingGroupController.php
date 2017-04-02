<?php

namespace Avem\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Avem\Http\Controllers\Controller;

use Avem\WorkingGroup;

class WorkingGroupController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('admin.workingGroups.index', [
			'workingGroups' => WorkingGroup::all(),
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('admin.workingGroups.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		WorkingGroup::create($request->all());
		return redirect()->route('admin.workingGroups.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \Avem\WorkingGroup  $workingGroup
	 * @return \Illuminate\Http\Response
	 */
	public function show(WorkingGroup $workingGroup)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \Avem\WorkingGroup  $workingGroup
	 * @return \Illuminate\Http\Response
	 */
	public function edit(WorkingGroup $workingGroup)
	{
		return view('admin.workingGroups.edit', [
			'workingGroup' => $workingGroup,
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
		$workingGroup->update($request->all());
		return redirect()->route('admin.working_group.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \Avem\WorkingGroup  $workingGroup
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(WorkingGroup $workingGroup)
	{
		$workingGroup->delete();
		return redirect()->route('admin.working_group.index');
	}
}
