<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Member;
use Carbon\Carbon;
use App\MemberRenewal;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MemberRequest;
use App\Http\Requests\Admin\RenewMemberRequest;

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
        return view('admin.manage.members.create');
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
        return view('admin.manage.members.edit', compact('member'));
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

    private function selfMember() {
        if ($user = Auth::user())
            return $user->member;
        return null;
    }

    private function renewalEndDate()
    {
        $now = Carbon::now();
        $date = config('avem.period_start')->copy();
        if ($date < $now) $date->addYear();
        return $date;
    }

    private function createMemberRenewal(Member $member, RenewMemberRequest $request)
    {
        $self = $this->selfMember();
        $renewal = new MemberRenewal;
        $renewal->until = $this->renewalEndDate();
        $renewal->applier()->associate($self->mbMember);
        $renewal->member()->associate($member);
        $renewal->save();
        return $renewal;
    }

    public function renew(Member $member, RenewMemberRequest $request)
    {
        $renewal = $this->createMemberRenewal($member, $request);
        flash()->success(trans('admin.renewals.renew.successMessage', [
            'name' => $member->full_name, 'until' => $renewal->until
        ]));
        return redirect('/admin/renewals');
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
