<?php

namespace Avem\Policies;

use Avem\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActivityTicketPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
