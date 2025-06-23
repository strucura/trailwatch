<?php

namespace Strucura\TrailWatch;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Strucura\TrailWatch\Commands\TrailWatchCommand;

class TrailWatchServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('route_events')
            ->hasConfigFile()
            ->hasMigration('create_route_events_table');
    }
}
