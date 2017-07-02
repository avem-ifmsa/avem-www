<?php

namespace Avem\Http\ViewComposers;

use Avem\Charge;
use Avem\MbMember;
use Illuminate\View\View;
use Illuminate\Http\Request;

class AdminMbMemberViewComposer
{
	private function getRequestedMbMembers(Request $request)
	{
		$showMembers = $request->input('showMembers', 'active');
		if ($showMembers == 'active') {
			$mbMembers = MbMember::active();
		} else {
			$mbMembers = MbMember::query();
		}

		if ($request->has('q')) {
			$filter = '%'.$request->input('q').'%';
			$mbMembers = $mbMembers->join('users', 'mb_members.id', '=', 'users.id')
			                       ->where(\DB::raw('users.name || " " || users.surname'), 'LIKE', $filter)
			                       ->orWhere('users.email', 'LIKE', $filter)
			                       ->select('mb_members.*');
		}

		return $mbMembers->get();
	}

    /**
     * Create a new profile composer.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with([
            'charges'   => Charge::all(),
            'mbMembers' => $this->getRequestedMbMembers($this->request),
        ]);
    }
}