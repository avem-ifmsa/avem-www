<?php

namespace Avem\Http\Controllers\Admin;

use DB;
use Session;
use Avem\Tag;
use Avem\User;
use Avem\Charge;
use Carbon\Carbon;
use Avem\ChargePeriod;
use Avem\WorkingGroup;
use Avem\ManagesTagsTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Avem\UsesWorkingGroupsTrait;
use Avem\Http\Controllers\Controller;

class ChargeController extends Controller
{
	use ManagesTagsTrait;
	use UsesWorkingGroupsTrait;

	private function currentPeriodEnd()
	{
		$period = Carbon::create(null, 9, 1);
		if (Carbon::now()->gt($period))
			$period->addYear();
		return $period;
	}

	private function getWorkingGroups()
	{
		$allWorkingGroups = $this->prefetchWorkingGroups(WorkingGroup::all());
		$topLevelGroups = $allWorkingGroups->where('parent_group_id', null);
		return $topLevelGroups->sortByDesc(function($workingGroup) {
			return $workingGroup->subgroups->count();
		});
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

		return view('admin.board.charges.create', [
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

			$chargeTags = $this->inputTags($request, 'tags');
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

		return view('admin.board.charges.edit', [
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

			$chargeTags = $this->inputTags($request, 'tags');
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
		$this->authorize('create', ChargePeriod::class);

		return view('admin.board.charges.assign', [
			'charge' => $charge,
		]);
	}

	/**
	 * Show confirm dialog for charge assignment.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Avem\Charge  $charge
	 * @return \Illuminate\Http\Response
	 */
	public function confirmAssign(Request $request, Charge $charge)
	{
		$this->authorize('create', ChargePeriod::class);

		$chargePeriodStart = Carbon::now();
		$currentPeriodEnd = $this->currentPeriodEnd();
		$user = User::findOrFail($request->input('user'));
		$upcomingPeriodEnd = $currentPeriodEnd->copy()->addYear();

		return view('admin.board.charges.confirm', [
			'user'              => $user,
			'charge'            => $charge,
			'currentPeriodEnd'  => $currentPeriodEnd,
			'upcomingPeriodEnd' => $upcomingPeriodEnd,
			'chargePeriodStart' => $chargePeriodStart,
		]);
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
