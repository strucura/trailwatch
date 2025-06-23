<?php

namespace Strucura\RouteActivities\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Strucura\RouteActivities\Models\RouteActivity;
use Symfony\Component\HttpFoundation\Response;

class LogRouteActivityMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if logging is enabled
        if (! config('trailwatch.logging.enabled', true)) {
            return $next($request);
        }

        $routeName = $request->route()?->getName();
        $routePath = $request->route()?->uri();

        // Check if the route is excluded
        $excludedNames = config('trailwatch.logging.exclude.names', []);
        $excludedPaths = config('trailwatch.logging.exclude.paths', []);
        if (in_array($routeName, $excludedNames) || $this->matchesPath($routePath, $excludedPaths)) {
            return $next($request);
        }

        // Log the route activity
        RouteActivity::query()->create([
            'name' => $routeName,
            'path' => $routePath,
            'ip_address' => config('trailwatch.logging.log_ip', true) ? $request->ip() : null,
            'user_agent' => config('trailwatch.logging.log_user_agent', true) ? $request->userAgent() : null,
            'user_id' => config('trailwatch.logging.log_user', true) ? $request->user()?->id : null,
        ]);

        return $next($request);
    }

    /**
     * Check if a path matches any patterns (supports wildcards).
     */
    protected function matchesPath(?string $path, array $patterns): bool
    {
        if (! $path) {
            return false;
        }

        foreach ($patterns as $pattern) {
            if (fnmatch($pattern, $path)) {
                return true;
            }
        }

        return false;
    }
}
