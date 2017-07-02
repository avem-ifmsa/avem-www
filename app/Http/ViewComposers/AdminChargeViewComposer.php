<?php

namespace Avem\Http\ViewComposers;

use Avem\Charge;
use Illuminate\View\View;

class AdminChargeViewComposer
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
        $view->with('charges', Charge::all());
    }
}