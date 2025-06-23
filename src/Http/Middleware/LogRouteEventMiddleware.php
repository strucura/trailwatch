<?php

namespace Strucura\RouteActivities\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Strucura\RouteActivities\Models\RouteActivity;
use Symfony\Component\HttpFoundation\Response;

class LogRouteEventMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        RouteActivity::query()->create([
            'name' => $request->route()?->getName(),
            'path' => $request->route()?->uri(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'user_id' => $request->user()?->id,
        ]);

        return $next($request);
    }
}
