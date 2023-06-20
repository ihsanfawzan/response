<?php

namespace Ihsanfawzan\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Response\Response\Response
 */
class Response extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Ihsanfawzan\Response::class;
    }
}
