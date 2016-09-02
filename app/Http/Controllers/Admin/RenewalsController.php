<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Member;
use Carbon\Carbon;
use App\MemberRenewal;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RenewMemberRequest;

class RenewalsController extends Controller
{

    public function index()
    {
        return view('admin.renewals', [
            'members' => Member::all()
        ]);
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
        $date->setTime(0, 0, 0);
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
        flash()->success(trans('admin.renewals.successMessage', [
            'name' => $member->full_name, 'until' => $renewal->until
        ]));
        return redirect('/admin/renewals');
    }

}
