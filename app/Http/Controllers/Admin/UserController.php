<?php

namespace Avem\Http\Controllers\Admin;

use Auth;
use Avem\Role;
use Avem\User;
use Avem\Renewal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Avem\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class UserController extends Controller
{
	/**
	 * Filter users by full name or email.
	 *
	 * @param \Illuminate\Http\Request  $request
	 * @param |Illuminate\Database\Eloquent\Builder  $query
	 */
	private function filterUsers(Request $request, Builder $query)
	{
		$filter = '%'.$request->input('q').'%';
		return $query->where(\DB::raw('name || " " || surname'), 'LIKE', $filter)
		             ->orWhere('email', 'LIKE', $filter);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$query = User::query();
		if ($request->has('q')) {
			$users = $this->filterUsers($request, $query);
		}

		return view('admin.users.index', [
			'users' => $query->get(),
		]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \Avem\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function edit(User $user)
	{
		return view('admin.users.edit', [
			'user'  => $user,
			'roles' => Role::all(),
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Avem\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, User $user)
	{
		$user->fill($request->except('password', 'photo'));

		if ($password = $request->input('password'))
			$user->password = bcrypt($password);

		if ($photo = $request->file('photo'))
			$user->setProfileImage($photo);

		$user->save();

		return redirect()->route('admin.users.index');
	}

	private function createUserRenewal(Request $request)
	{
		$mbMemberPeriods = Auth::user()->mbMember->mbMemberPeriods();
		$activePeriod = $mbMemberPeriods->active()->first();

		$renewUntil = $this->nextRenewalDate();
		$renewal = new Renewal([ 'until' => $renewUntil ]);
		$renewal->issuerPeriod()->associate($activePeriod);

		return $renewal;
	}

	private function nextRenewalDate()
	{
		$date = Carbon::now();
		$until = Carbon::createFromDate(null, 9, 1);
		return $date < $until ? $until : $until->addYear();
	}

	public function renew(Request $request, User $user)
	{
		$this->authorize($user);

		$renewal = $this->createUserRenewal($request);
		$user->renewals()->save($renewal);

		return redirect()->route('admin.users.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \Avem\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(User $user)
	{
		$this->authorize();

		$user->delete();
		return redirect()->route('admin.users.index');
	}
}
