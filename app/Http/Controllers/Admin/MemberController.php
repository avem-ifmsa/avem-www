<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Member;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\MemberRequest;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::all();
        return view('admin.manage.members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all()->pluck('email', 'id');
        return view('admin.manage.members.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MemberRequest $request)
    {
        Member::create($request->all());
        flash()->success(trans('admin.manage.members.create.successMessage'));
        return redirect()->route('admin.manage.members.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        $users = User::all()->pluck('email', 'id');
        return view('admin.manage.members.edit', compact('member', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Member $member, MemberRequest $request)
    {
        $member->update($request->all());
        flash()->success(trans('admin.manage.members.edit.successMessage'));
        return redirect()->route('admin.manage.members.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        $member->delete();
        flash()->success(trans('admin.manage.members.delete.successMessage'));
        return redirect()->route('admin.manage.members.index');
    }
}
