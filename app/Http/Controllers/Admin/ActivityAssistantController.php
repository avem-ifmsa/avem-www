<?php

namespace Avem\Http\Controllers\Admin;

use Avem\Activity;
use Illuminate\Http\Request;
use Avem\Http\Controllers\Controller;

class ActivityAssistantController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @param  \Avem\Activity $activity
	 * @return \Illuminate\Http\Response
	 */
	public function index(Activity $activity)
	{
		return view('admin.activities.assistants.index', [
			'activity' => $activity,
		]);
	}
}
