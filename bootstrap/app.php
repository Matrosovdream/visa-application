<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isUser;
use App\Http\Middleware\isUserOrder;
use App\Http\Middleware\hasRole;
use App\Http\Middleware\isOrderPaid;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'isAdmin' => isAdmin::class,
            'isUser' => isUser::class,
            'hasRole' => hasRole::class,
            'isUserOrder' => isUserOrder::class,
            'isOrderPaid' => isOrderPaid::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
