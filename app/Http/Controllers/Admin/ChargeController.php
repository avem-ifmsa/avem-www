<?php

namespace Avem\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Avem\Http\Controllers\Controller;

use Avem\Charge;
use Avem\WorkingGroup;

class ChargeController extends Controller
{
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
		Charge::create($request->all());
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
		$charge->update($request->all());
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
