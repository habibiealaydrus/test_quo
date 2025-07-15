<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'superAdmin'        => \App\Http\Middleware\Role\superAdmin::class,
            'sales'      => \App\Http\Middleware\Role\sales::class,
            'nonSales'   => \App\Http\Middleware\Role\nonSales::class,
            'public_area' => \App\Http\Middleware\Role\PublicAreaOnly::class,
            ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
