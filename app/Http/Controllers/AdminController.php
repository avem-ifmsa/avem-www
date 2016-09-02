<?php

namespace App\Http\Controllers;

use App\Member;
use App\MbMember;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    public function index()
    {
        return view('admin.panel');
    }

    public function manage()
    {
        return view('admin.manage.panel');
    }

    public function statistics()
    {
        return view('admin.statistics');
    }

    public function activities()
    {
        return view('admin.activities');
    }

    public function exchanges()
    {
        return view('admin.exchanges');
    }

    public function mbMembers()
    {
        return view('admin.mbMembers', [
            'mbMembers' => MbMember::all()
        ]);
    }

}
