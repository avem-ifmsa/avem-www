<?php

namespace Avem\Http\Controllers\Admin;

use Avem\Charge;
use Avem\WorkingGroup;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Avem\Http\Controllers\Controller;


class ChargeController extends Controller
{
	/**
	 * Validation rules against a given charge.
	 *
	 * @param mixed  $charge
	 * @return mixed
	 */
	private function rules($charge = null) {
		return [
			'email' => [
				'required', 'email', 'unique:users',
				Rule::unique('charges')->ignore($charge ? $charge->id : null),
			],
		];
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('admin.charges.index', [
			'charges' => Charge::all(),
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('admin.charges.create', [
			'workingGroups' => WorkingGroup::all(),
			'allCharges'    => Charge::orderBy('order')->get(),
		]);
	}

	private function updateChargeOrdering($orderedChargeIds)
	{
		foreach ($orderedChargeIds as $index => $chargeId) {
			Charge::where('id', $chargeId)->update([ 'order' => $index ]);
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, $this->rules());

		$ordered = $request->input('order');
		$newCharge = new Charge($request->except('order'));
		$newCharge->order = array_search('new', $ordered);
		$newCharge->save();

		unset($ordered[$newCharge->order]);
		$this->updateChargeOrdering($ordered);

		return redirect()->route('admin.charges.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \Avem\Charge  $charge
	 * @return \Illuminate\Http\Response
	 */
	public function show(Charge $charge)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \Avem\Charge  $charge
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Charge $charge)
	{
		return view('admin.charges.edit', [
			'charge'        => $charge,
			'workingGroups' => WorkingGroup::all(),
			'allCharges'    => Charge::orderBy('order')->get(),
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
		$this->validate($request, $this->rules($charge));

		$ordered = $request->input('order');
		$charge->update($request->except('order'));

		$this->updateChargeOrdering($ordered);

		return redirect()->route('admin.charges.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \Avem\Charge  $charge
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Charge $charge)
	{
		$charge->delete();
		return redirect()->route('admin.charges.index');
	}
}
