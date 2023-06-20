<?php

namespace Ihsanfawzan\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ihsanfawzan\Response
 */
class Response extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Ihsanfawzan\Response::class;
    }
}
