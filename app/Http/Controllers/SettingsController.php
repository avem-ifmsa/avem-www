<?php

namespace Avem\Http\Controllers;

use DB;
use Auth;
use Session;
use Newsletter;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
	/**
	 * Show the settings page.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('main.settings', [
			'user' => Auth::user(),
		]);
	}

	/**
	 * Store user settings.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		DB::transaction(function() use ($request) {
			$user = $request->user();
			$user->fill($request->except('password', 'photo'));

			if ($request->has('password'))
				$user->password = bcrypt($request->input('password'));

			if ($request->hasFile('photo')) {
				if ($user->profileImage !== null)
					$user->profileImage->delete();

				$user->addMediaFromRequest('photo')
				     ->toMediaCollection('avatars');
			}

			$user->save();
		});

		return redirect()->route('home.settings');
	}

	public function subscribeNewsletter()
	{
		if (!Newsletter::subscribeOrUpdate(Auth::user()->email))
			Session::flash('newsletterError', Newsletter::getLastError());

		return redirect()->to(route('home.settings').'#correos');
	}

	public function unsubscribeNewsletter()
	{
		if (!Newsletter::unsubscribe(Auth::user()->email))
			Session::flash('newsletterError', Newsletter::getLastError());

		return redirect()->to(route('home.settings').'#correos');
	}

	public function deleteAccount()
	{
		return view('main.account.delete', [
			'user' => Auth::user(),
		]);
	}

	public function confirmDeleteAccount()
	{
		Auth::user()->delete();

		return redirect()->route('home.welcome');
	}
}
