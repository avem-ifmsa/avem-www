<?php

namespace Avem\Http\Controllers\Admin;

use Avem\Exchange;
use Avem\Destination;
use Illuminate\Http\Request;
use Avem\Http\Controllers\Controller;

class ExchangeController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('admin.exchanges.index', [
			'exchanges' => Exchange::all(),
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('admin.exchanges.create');
	}

	private function getExchangeDestination(Request $request)
	{
		$info = $request->input('destination');
		$filter = array_only($info, ['name', 'type']);
		$destination = Destination::firstOrCreate($filter, $info);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$destination = $this->getExchangeDestination($request);
		$exchange = new Exchange($request->except('destination'));
		$exchange->destination()->save($destination);
		$exchange->save();

		return redirect()->route('admin.exchanges.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \Avem\Exchange  $exchange
	 * @return \Illuminate\Http\Response
	 */
	public function show(Exchange $exchange)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \Avem\Exchange  $exchange
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Exchange $exchange)
	{
		return view('admin.exchanges.edit', [
			'exchange' => $exchange,
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Avem\Exchange  $exchange
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Exchange $exchange)
	{
		$destination = $this->getExchangeDestination($request);
		$exchange->destination()->save($destination);
		$exchange->update($request->except('destination'));

		return redirect()->route('admin.exchanges.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \Avem\Exchange  $exchange
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Exchange $exchange)
	{
		$exchange->delete();
		return redirect()->route('admin.exchanges.index');
	}
}
