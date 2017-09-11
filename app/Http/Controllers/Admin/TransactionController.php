<?php

namespace Avem\Http\Controllers\Admin;

use Auth;
use Avem\User;
use Avem\Transaction;
use Avem\PlainTransaction;
use Illuminate\Http\Request;
use Avem\Http\Controllers\Controller;

class TransactionController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(User $user)
	{
		$transactions = $user->transactions();
		$transactions->load('applierPeriod.user');

		return view('admin.users.transactions.index', [
			'user'         => $user,
			'transactions' => $transactions->sortByDesc('created_at'),
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param  \Avem\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function create(User $user)
	{
		$this->authorize(Transaction::class);

		$issuerPeriod = Auth::user()->currentChargePeriod;

		return view('admin.users.transactions.create', [
			'user'         => $user,
			'issuerPeriod' => $issuerPeriod,
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Avem\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request, User $user)
	{
		$this->authorize('create', Transaction::class);

		$transaction = new PlainTransaction($request->all());
		$transaction->user()->associate($user);
		$chargePeriod = $request->user()->currentChargePeriod;
		$transaction->applierPeriod()->associate($chargePeriod);
		$transaction->save();

		return redirect()->route('admin.users.transactions.index', [$user]);
	}
}
