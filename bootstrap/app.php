<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

// Rediriger bootstrap/cache vers /tmp sur Vercel (filesystem read-only)
if (getenv('VERCEL')) {
    $tmpBootstrap = '/tmp/bootstrap/cache';
    if (!is_dir($tmpBootstrap)) {
        mkdir($tmpBootstrap, 0777, true);
    }
    $app->useStoragePath('/tmp/storage');
}

return $app;