<?php

namespace Strucura\TrailWatch;

use Strucura\TrailWatch\Models\RouteActivity;

class TrailWatch
{
    public function logRouteActivity(
        ?string $routeName,
        ?string $routePath,
        ?string $ipAddress,
        ?string $userAgent,
        ?int $userId
    ): void {
        if (! config('trailwatch.logging.enabled', true)) {
            return;
        }

        $excludedNames = config('trailwatch.logging.exclude.names', []);
        $excludedPaths = config('trailwatch.logging.exclude.paths', []);
        if (in_array($routeName, $excludedNames) || $this->matchesPath($routePath, $excludedPaths)) {
            return;
        }

        RouteActivity::query()->create([
            'name' => $routeName,
            'path' => $routePath,
            'ip_address' => config('trailwatch.logging.log_ip', true) ? $ipAddress : null,
            'user_agent' => config('trailwatch.logging.log_user_agent', true) ? $userAgent : null,
            'user_id' => config('trailwatch.logging.log_user', true) ? $userId : null,
        ]);
    }

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
