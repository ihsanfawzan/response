<?php

namespace Response\Response\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Response\Response\Response
 */
class Response extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Response\Response\Response::class;
    }
}
