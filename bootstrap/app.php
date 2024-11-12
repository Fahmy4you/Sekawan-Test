<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use \App\Http\Middleware\{cekBeberapaRole, LoadNotifikasi};

return Application::configure(basePath: dirname(__DIR__))
->withRouting(
    web: __DIR__.'/../routes/web.php',
    commands: __DIR__.'/../routes/console.php',
    health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo(fn (Request $request) => route('auth.login'));
        $middleware->alias([
            'cekRole' => cekBeberapaRole::class,
            'notifikasi' => LoadNotifikasi::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
