<?php

namespace App\Http\Controllers\Admin\Manage;

use App\MbCharge;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MbChargeRequest;

class MbChargeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mbCharges = MbCharge::all();
        return view('admin.manage.mbCharges.index', compact('mbCharges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.manage.mbCharges.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MbChargeRequest $request)
    {
        MbCharge::create($request->all());
        flash()->success(trans('admin.manage.mbCharges.create.successMessage'));
        return redirect()->route('admin.manage.mb-charges.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(MbCharge $mbCharge)
    {
        return view('admin.manage.mbCharges.edit', compact('mbCharge'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MbCharge $mbCharge, MbChargeRequest $request)
    {
        $mbCharge->update($request->all());
        flash()->success(trans('admin.manage.mbCharges.edit.successMessage'));
        return redirect()->route('admin.manage.mb-charges.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MbCharge $mbCharge)
    {
        $mbCharge->delete();
        flash()->success(trans('admin.manage.mbCharges.delete.successMessage'));
        return redirect()->route('admin.manage.mb-charges.index');
    }
}
