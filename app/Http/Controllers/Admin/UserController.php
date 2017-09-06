<?php

namespace Avem\Http\Controllers\Admin;

use Auth;
use Avem\Role;
use Avem\User;
use Illuminate\Http\Request;
use Avem\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class UserController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @param \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		return view('admin.users.index');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \Avem\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function edit(User $user)
	{
		$this->authorize('update', $user);

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
		$this->authorize('update', $user);

		$user->fill($request->except('password', 'photo'));

		if ($password = $request->input('password'))
			$user->password = bcrypt($password);

		if ($photo = $request->hasFile('photo')) {
			if ($user->profileImage !== null)
				$user->profileImage->delete();

			$user->addMediaFromRequest('photo')
			     ->toMediaLibrary('avatars');
		}

		$user->save();

		return redirect()->route('admin.users.index');
	}

	public function confirmDelete(User $user)
	{
		$this->authorize('delete', $user);

		return view('admin.users.delete', [
			'user' => $user,
		]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \Avem\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(User $user)
	{
		$this->authorize('delete', $user);

		$user->delete();

		return redirect()->route('admin.users.index');
	}
}
