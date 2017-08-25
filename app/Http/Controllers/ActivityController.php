<?php

namespace Avem\Http\Controllers;

use Auth;
use Avem\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
	public function index()
	{

	}

	public function subscribe(Activity $activity)
	{
		$this->middleware('auth');

		$user = Auth::user();
		$user->selfInscribedActivities()->save($activity);

		return redirect()->route('home');
	}

	public function unsubscribe(Activity $activity)
	{
		$this->middleware('auth');

		$user = Auth::user();
		$user->selfInscribedActivities()->detach($activity);

		return redirect()->route('home');
	}
}
