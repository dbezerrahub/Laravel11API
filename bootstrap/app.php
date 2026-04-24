<?php

use App\Exceptions\Handler;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use App\Http\Middleware\EndpointAuthorizationMiddleware;
use App\Http\Middleware\RedirectIfUnauthenticated;
use App\Jobs\DeleteExpiredTokens;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Response;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'sanctum' => EnsureFrontendRequestsAreStateful::class,
            'EndpointAuthorizationMiddleware' => EndpointAuthorizationMiddleware::class,
            'redirect.if.unauthenticated' => RedirectIfUnauthenticated::class,

        ]);
    })
    ->withSchedule(function(Schedule $schedule) {
        // Execute php artisan schedule:run para rodar os jobs
        // Execute php artisan schedule:run para listar os jobs
        $schedule->job(new DeleteExpiredTokens())->everyTenSeconds();
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Tratar exceções gerais, como erro 500 (Internal Server Error)
        $handler = new Handler();
        $handler->renderException($exceptions);
    })
    ->withProviders([
        App\Providers\HorizonServiceProvider::class,
    ])
    ->create();
