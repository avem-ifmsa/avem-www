<?php

namespace Avem\Http\ViewComposers;

use Avem\User;
use Illuminate\View\View;

class AdminUsersViewComposer
{
	/**
	 * Create a new profile composer.
	 *
	 * @return void
	 */
	public function __construct()
	{
	}

	/**
	 * Bind data to the view.
	 *
	 * @param  View  $view
	 * @return void
	 */
	public function compose(View $view)
	{
		$request = request();
		$q = $request->input('q');
		$view->with('q', $q);

		if ($q !== null) {
			$view->with('users', User::search($q)->get());
		} else {
			$view->with('users', User::all());
		}
	}
}
