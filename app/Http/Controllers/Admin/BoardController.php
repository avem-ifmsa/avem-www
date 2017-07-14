<?php

namespace Avem\Http\Controllers\Admin;

use Avem\WorkingGroup;
use Illuminate\Http\Request;
use Avem\Http\Controllers\Controller;

class BoardController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @param \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		return view('admin.board.index', [
			'workingGroups' => WorkingGroup::with('charges', 'charges.periods', 'subgroups')
			                               ->where('parent_group_id', null)
			                               ->orderBy('index')->get(),
		]);
	}

}
