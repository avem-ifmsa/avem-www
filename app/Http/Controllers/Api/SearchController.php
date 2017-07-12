<?php

namespace Avem\Http\Controllers\Api;

use Avem\User;
use Avem\Activity;
use Avem\Exchange;
use Illuminate\Http\Request;
use Avem\Http\Controllers\Controller;

class SearchController extends Controller
{

	public function searchUsers(Request $request)
	{
		return User::search($request->input('q'))->get();
	}

	public function searchActivities(Request $request)
	{
		return Activity::search($request->input('q'))->get();
	}

	public function searchExchanges(Request $request)
	{
		return Exchange::search($request->input('q'))->get();
	}

};