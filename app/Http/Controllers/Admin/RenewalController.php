<?php

namespace Avem\Http\Controllers\Admin;

use Avem\User;
use Avem\Renewal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Avem\Http\Controllers\Controller;

class RenewalController extends Controller
{
	private function nextRenewalDate()
	{
		$date = Carbon::now();
		$until = Carbon::createFromDate(null, 9, 1);
		return $date < $until ? $until : $until->addYear();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param  \Avem\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function create(User $user)
	{
		$this->authorize(Renewal::class);

		return view('admin.users.renewals.create', [
			'user' => $user,
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
		$this->authorize(Renewal::class);

		$renewal = new Renewal;
		$renewal->until = $this->nextRenewalDate();
		$renewal->user()->associate($user);
		$renewal->save();

		return redirect()->route('admin.users.index');
	}

	public function confirmDelete(User $user, Renewal $renewal)
	{
		$this->authorize('delete', $renewal);

		return view('admin.users.renewals.delete', [
			'user'    => $user,
			'renewal' => $renewal,
		]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(User $user, Renewal $renewal)
	{
		$this->authorize($renewal);

		$renewal->delete();

		return redirect()->route('admin.users.index');
	}
}
