<?php

namespace Avem\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('main.welcome');
	}
}
