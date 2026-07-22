<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CheckMaintenanceMode;
use App\Http\Middleware\LanguageManager;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as AuthMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => AdminMiddleware::class,
        ]);

        $middleware->web(append: [
            \App\Http\Middleware\TrackVisitor::class,
            LanguageManager::class,
            CheckMaintenanceMode::class,
        ]);
        
        // Override default authentication redirect
        $middleware->redirectGuestsTo(fn () => route('admin.login'));
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Redirect unauthenticated admin requests to admin login page
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            if ($request->is('admin*') || $request->expectsJson() === false) {
                return redirect()->guest(route('admin.login'));
            }
        });
    })->create();
