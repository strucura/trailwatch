<?php

namespace Strucura\TrailWatch\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Strucura\TrailWatch\TrailWatch
 */
class TrailWatch extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Strucura\TrailWatch\TrailWatch::class;
    }
}
