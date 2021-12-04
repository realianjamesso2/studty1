<?php

namespace MakeEasySolutions\AccountPart\Facades;

use Illuminate\Support\Facades\Facade;

class AccountPart extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'account-part';
    }
}
