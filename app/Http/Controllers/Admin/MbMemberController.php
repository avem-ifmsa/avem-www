<?php

namespace Avem\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Avem\Http\Controllers\Controller;

use Avem\User;
use Avem\MbMember;

class MbMemberController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('admin.mb_members.index', [
			'mbMembers' => MbMember::all(),
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('admin.mb_members.create', [
			'users' => User::all(),
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$user = User::findOrFail($request->input('user'));
		$user->mbMember()->create($request->except('user'));
		return redirect()->route('admin.mb_members.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \Avem\MbMember  $mbMember
	 * @return \Illuminate\Http\Response
	 */
	public function show(MbMember $mb_member)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \Avem\MbMember  $mbMember
	 * @return \Illuminate\Http\Response
	 */
	public function edit(MbMember $mb_member)
	{
		return view('admin.mb_members.edit', [
			'mbMember' => $mb_member,
			'users'    => User::all(),
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Avem\MbMember  $mbMember
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, MbMember $mb_member)
	{
		$mb_member->fill($request->all());
		$mb_member->user()->associate($request->input('user'));
		$mb_member->save();

		return redirect()->route('admin.mb_members.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \Avem\MbMember  $mbMember
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(MbMember $mb_member)
	{
		$mb_member->delete();
		return redirect()->route('admin.mb_members.index');
	}
}
