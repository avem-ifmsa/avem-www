<?php

namespace Avem\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the user dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('main.home');
	}

	/**
	 *
	 * Show user transactions.
	 *
	 * @return  \Illuminate\Http\Response
	 */
	public function transactions()
	{
		$user = Auth::user();
		$transactions = $user->transactions()->sortByDesc('created_at');

		return view('main.points', [
			'transactions' => $transactions,
		]);
	}
}
