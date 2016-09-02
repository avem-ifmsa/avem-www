<?php

namespace App\Http\Controllers\Admin\Manage;

use App\Member;
use App\MbMember;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MbMemberRequest;

class MbMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mbMembers = MbMember::all();
        return view('admin.manage.mbMembers.index', compact('mbMembers'));
    }

    private function memberList()
    {
        return Member::all()->reduce(function($list, $member) {
            $list[$member->id] = $member->full_name.' ('.$member->id.')';
            return $list;
        }, [ null ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = $this->memberList();
        return view('admin.manage.mbMembers.create', compact('members'));
    }

    private function createMember(MbMemberRequest $request)
    {
        $mbMember = new MbMember($request->all());
        $this->setMember($mbMember, $request);
        $mbMember->save();
        return $mbMember;
    }

    private function setMember(MbMember $mbMember, MbMemberRequest $request)
    {
        if ($memberId = $request->input('member'))
            $mbMember->member()->associate(Member::findOrFail($memberId));
        else
            $mbMember->member()->detach();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MbMemberRequest $request)
    {
        $this->createMember($request);
        flash()->success(trans('admin.manage.mbMembers.create.successMessage'));
        return redirect()->route('admin.manage.mb-members.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(MbMember $mbMember)
    {
        $members = $this->memberList();
        return view('admin.manage.mbMembers.edit', compact('mbMember', 'members'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MbMember $mbMember, MbMemberRequest $request)
    {
        $mbMember->update($request->all());
        $this->setMember($mbMember, $request);

        flash()->success(trans('admin.manage.mbMembers.edit.successMessage'));
        return redirect()->route('admin.manage.mbMembers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MbMember $mbMember)
    {
        $mbMember->delete();
        flash()->success(trans('admin.manage.mbMembers.delete.successMessage'));
        return redirect()->route('admin.manage.mb-members.index');
    }
}
