<?php

namespace App\Http\Controllers\Admin;

use App\MbMember;
use App\MbCharge;
use Carbon\Carbon;
use App\Http\Requests;
use App\MbMemberPeriod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ActivateMbMemberRequest;

class MbMembersController extends Controller
{

    private function mbChargeList()
    {
        return MbCharge::all()->pluck('name', 'id')->toArray();
    }

    public function index()
    {
        return view('admin.mbMembers', [
            'mbMembers' => MbMember::all(),
            'mbCharges' => $this->mbChargeList(),
        ]);
    }

    private function periodEndDate()
    {
        $now = Carbon::now();
        $date = config('avem.period_start')->copy();
        if ($date < $now) $date->addYear();
        $date->setTime(0, 0, 0);
        return $date;
    }

    private function createMbMemberPeriod(MbMember $mbMember, MbCharge $charge,
                                          ActivateMbMemberRequest $request)
    {
        $period = new MbMemberPeriod;
        $period->start = Carbon::now();
        $period->end = $this->periodEndDate();
        $period->mbCharge()->associate($charge);
        $period->mbMember()->associate($mbMember);
        $period->save();
        return $period;
    }

    public function activate(MbMember $mbMember, ActivateMbMemberRequest $request)
    {
        $charge = MbCharge::findOrFail($request->input('mb_charge'));
        if ($current = $mbMember->current_period)
            $current->update([ 'end' => Carbon::now() ]);
        $period = $this->createMbMemberPeriod($mbMember, $charge, $request);
        flash()->success(trans('admin.mbMembers.successMessage', [
            'charge' => $charge->name, 'until' => $period->end,
            'name' => $mbMember->member->full_name,
        ]));
        return redirect('/admin/mb-members');
    }

}
