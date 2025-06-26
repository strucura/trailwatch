<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Config;
use Strucura\TrailWatch\Models\RouteActivity;
use Strucura\TrailWatch\TrailWatch;

uses(DatabaseTransactions::class);

beforeEach(function () {
    $this->trailWatch = new TrailWatch;
});

it('does not log when logging is disabled', function () {
    Config::set('trailwatch.logging.enabled', false);

    $this->trailWatch->logRouteActivity('home', '/home', '127.0.0.1', 'Mozilla/5.0', 1);

    $this->assertDatabaseMissing(RouteActivity::class, ['name' => 'home']);
});

it('does not log excluded route names', function () {
    Config::set('trailwatch.logging.exclude.names', ['home']);

    $this->trailWatch->logRouteActivity('home', '/home', '127.0.0.1', 'Mozilla/5.0', 1);

    $this->assertDatabaseMissing(RouteActivity::class, ['name' => 'home']);
});

it('does not log excluded route paths', function () {
    Config::set('trailwatch.logging.exclude.paths', ['admin/*']);

    $this->trailWatch->logRouteActivity('dashboard', 'admin/dashboard', '127.0.0.1', 'Mozilla/5.0', 1);

    $this->assertDatabaseMissing(RouteActivity::class, ['path' => 'admin/dashboard']);
});

it('logs route activity when all conditions are met', function () {
    Config::set('trailwatch.logging.enabled', true);
    Config::set('trailwatch.logging.exclude.names', []);
    Config::set('trailwatch.logging.exclude.paths', []);

    $this->trailWatch->logRouteActivity('home', '/home', '127.0.0.1', 'Mozilla/5.0', 1);

    $this->assertDatabaseHas(RouteActivity::class, [
        'name' => 'home',
        'path' => '/home',
        'ip_address' => '127.0.0.1',
        'user_agent' => 'Mozilla/5.0',
        'user_id' => 1,
    ]);
});

it('respects log_user, log_ip, and log_user_agent configurations', function () {
    Config::set('trailwatch.logging.log_user', false);
    Config::set('trailwatch.logging.log_ip', false);
    Config::set('trailwatch.logging.log_user_agent', false);

    $this->trailWatch->logRouteActivity('home', '/home', '127.0.0.1', 'Mozilla/5.0', 1);

    $this->assertDatabaseHas(RouteActivity::class, [
        'name' => 'home',
        'path' => '/home',
        'ip_address' => null,
        'user_agent' => null,
        'user_id' => null,
    ]);
});
