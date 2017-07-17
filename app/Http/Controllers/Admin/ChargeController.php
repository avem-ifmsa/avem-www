<?php

namespace Avem\Http\Controllers\Admin;

use DB;
use Session;
use Avem\Tag;
use Avem\Charge;
use Avem\ChargePeriod;
use Avem\WorkingGroup;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Avem\Http\Controllers\Controller;

class ChargeController extends Controller
{
	private function prefetchWorkingGroups($workingGroups)
	{
		foreach ($workingGroups as $parentGroup) {
			$parentGroup->subgroups = $workingGroups->where('parent_group_id', $parentGroup->id);
			foreach ($parentGroup->subgroups as $childGroup)
				$childGroup->parentGroup = $parentGroup;
		}
		return $workingGroups;
	}

	private function getWorkingGroups()
	{
		$allWorkingGroups = $this->prefetchWorkingGroups(WorkingGroup::all());
		$topLevelGroups = $allWorkingGroups->where('parent_group_id', null);
		return $topLevelGroups->sortByDesc(function($workingGroup) {
			return $workingGroup->subgroups->count();
		});
	}

	private function getInputTags(Request $request)
	{
		$tagNames = explode(',', $request->input('tags'));
		$tagNames = array_map('trim', $tagNames);

		$existingTags = Tag::whereIn('name', $tagNames)->get();
		$existingTagNames = $existingTags->pluck('name')->toArray();
		$otherTagNames = array_diff($tagNames, $existingTagNames);
		Tag::insert(array_map(function($tagName) {
			return [ 'name' => $tagName ];
		}, $otherTagNames));

		$otherTags = Tag::whereIn('name', $otherTagNames)->get();
		return $existingTags->merge($otherTags);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(Request $request)
	{
		$this->authorize('create', Charge::class);

		if ($chargeGroup = $request->input('workingGroup'))
			Session::flash('_old_input.working_group', $chargeGroup);

		return view('admin.charges.create', [
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
		$this->authorize('create', Charge::class);

		DB::transaction(function() use ($request) {
			$charge = new Charge($request->all());
			if ($workingGroupId = $request->input('working_group')) {
				$charge->workingGroup()->associate($workingGroupId);
			}
			$charge->save();

			$chargeTags = $this->getInputTags($request);
			$charge->ownTags()->sync($chargeTags->pluck('id'));
		});

		return redirect()->route('admin.board');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \Avem\Charge  $charge
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Charge $charge)
	{
		$this->authorize('update', $charge);

		return view('admin.charges.edit', [
			'charge'        => $charge,
			'workingGroups' => $this->getWorkingGroups(),
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Avem\Charge  $charge
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Charge $charge)
	{
		$this->authorize('update', $charge);

		DB::transaction(function() use ($request, $charge) {
			$charge->fill($request->all());
			if ($workingGroupId = $request->input('working_group')) {
				$charge->workingGroup()->associate($workingGroupId);
			}
			$charge->save();

			$chargeTags = $this->getInputTags($request);
			$charge->ownTags()->sync($chargeTags->pluck('id'));
		});

		return redirect()->route('admin.board');
	}

	/**
	 * Show assign charge dialog.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Avem\Charge  $charge
	 * @return \Illuminate\Http\Response
	 */
	public function assign(Request $request, Charge $charge)
	{
		return view('admin.charges.assign', [
			'charge' => $charge,
		]);
	}

	/**
	 * Assign given charge to an existing user.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Avem\Charge  $charge
	 * @return \Illuminate\Http\Response
	 */
	public function doAssign(Request $request, Charge $charge)
	{
		$this->authorize('create', ChargePeriod::class);

		$chargePeriod = new ChargePeriod;
		$chargePeriod->start = Carbon::now();
		$chargePeriod->end = $request->input('end');

		$chargeUser = User::findOrFail($request->input('user'));
		$chargePeriod->user()->associate($chargeUser);
		$chargePeriod->charge()->associate($charge);

		$chargePeriod->save();

		return redirect()->route('admin.board');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \Avem\Charge  $charge
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Charge $charge)
	{
		$this->authorize('delete', $charge);

		$charge->delete();

		return redirect()->route('admin.board');
	}
}
