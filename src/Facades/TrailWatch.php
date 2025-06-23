<?php

namespace Strucura\TrailWatch\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static logRouteActivity(?string $routeName, ?string $routePath, ?string $ipAddress, ?string $userAgent, ?int $userId)
 *
 * @see \Strucura\TrailWatch\TrailWatch
 */
class TrailWatch extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Strucura\TrailWatch\TrailWatch::class;
    }
}
