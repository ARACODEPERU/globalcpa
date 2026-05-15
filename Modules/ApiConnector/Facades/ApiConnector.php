<?php

namespace Modules\ApiConnector\Facades;

use Illuminate\Support\Facades\Facade;

class ApiConnector extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'apiconnector';
    }
}
