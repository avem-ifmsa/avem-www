<?php

namespace Avem\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Avem\Http\Controllers\Controller;

class IndexController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @param \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		return view('admin.index');
	}
}
