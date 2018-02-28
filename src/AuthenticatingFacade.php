<?php

namespace Gjpgwa\Authenticating;

use Illuminate\Support\Facades\Facade;

class AuthenticatingFacade extends Facade {

    protected static function getFacadeAccessor() {
        return 'authenticating';
    }

}