<?php

namespace Avem\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('admin.activities.*', 'Avem\Http\ViewComposers\AdminActivityViewComposer');
        View::composer('admin.charges.*'   , 'Avem\Http\ViewComposers\AdminChargeViewComposer'  );
        View::composer('admin.mbMembers.*' , 'Avem\Http\ViewComposers\AdminMbMemberViewComposer');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
