<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Strucura\TrailWatch\Http\Middleware\LogRouteActivityMiddleware;

it('logs route activity when all conditions are met', function () {
    Config::set('trailwatch.logging.enabled', true);

    // Create a mock request
    $request = Request::create('/test-route', 'GET');
    $request->setRouteResolver(function () {
        return Route::get('/test-route')->name('test-route');
    });

    // Call the middleware
    $middleware = new LogRouteActivityMiddleware;
    $middleware->handle($request, function ($req) {
        return response('OK');
    });

    // Assert the database has the logged route activity
    $this->assertDatabaseHas('route_activities', [
        'name' => 'test-route',
        'path' => 'test-route',
    ]);
});

it('does not log when logging is disabled', function () {
    Config::set('trailwatch.logging.enabled', false);

    $request = Request::create('/test-route', 'GET');
    $request->setRouteResolver(function () {
        return Route::get('/test-route')->name('test-route');
    });

    $middleware = new LogRouteActivityMiddleware;
    $middleware->handle($request, function ($req) {
        return response('OK');
    });

    $this->assertDatabaseMissing('route_activities', [
        'name' => 'test-route',
    ]);
});
