<?php

namespace Strucura\TrailWatch\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Strucura\TrailWatch\Facades\TrailWatch;
use Symfony\Component\HttpFoundation\Response;

class LogRouteActivityMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $routeName = $request->route()?->getName();
        $routePath = $request->route()?->uri();
        $ipAddress = $request->ip();
        $userAgent = $request->userAgent();
        $userId = $request->user()?->id;

        // Pass extracted values to the logger
        TrailWatch::logRouteActivity($routeName, $routePath, $ipAddress, $userAgent, $userId);

        return $next($request);
    }
}
