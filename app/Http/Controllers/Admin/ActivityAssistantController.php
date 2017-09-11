<?php

namespace Avem\Http\Controllers\Admin;

use Avem\User;
use Avem\Activity;
use Avem\PerformedActivity;
use Illuminate\Http\Request;
use Avem\Http\Controllers\Controller;

class ActivityAssistantController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Avem\Activity $activity
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request, Activity $activity)
	{
		$activity->load('performedActivityRecords');

		$users = $activity->inscribedUsers();
		if ($q = $request->input('q')) {
			$filter = User::search($q)->get();
			$users = $users->filter(function($user) use ($filter) {
				return $filter->contains('id', $user->id);
			});
		}

		return view('admin.activities.assistants.index', [
			'activity' => $activity,
			'users'    => $users,
			'q'        => $q,
		]);
	}

	/**
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Avem\Activity $activity
	 * @param  \Avem\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function witness(Request $request, Activity $activity, User $user)
	{
		$this->authorize('update', $activity);

		if ($request->input('performed')) {
			$performedActivity = new PerformedActivity;
			$performedActivity->user()->associate($user);
			$chargePeriod = $request->user()->currentChargePeriod;
			$performedActivity->witnessPeriod()->associate($chargePeriod);
			$performedActivity->activity()->associate($activity);
			$performedActivity->save();
		} else {
			$activity->performedActivityRecords()->where('user_id', $user->id)->delete();
		}

		return redirect()->route('admin.activities.assistants.index', [$activity]);
	}
}
