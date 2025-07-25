<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
          $exceptions->renderable(function (Throwable $e, $request) {
            if ($request->is('api/*')) {
                if ($e instanceof ValidationException) {
                    return response()->json([
                        'status' => 'error',
                        'message' => $e->getMessage(),
                        'errors' => $e->errors(),
                    ], 422);
                }

                if ($e instanceof AuthenticationException) {
                    return response()->json([
                        'status' => 'error',
                        'message' => $e->getMessage(),
                    ], 401);
                }

                if ($e instanceof NotFoundHttpException) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Route introuvable',
                    ], 404);
                }

                return response()->json([
                    'status' => 'error',
                    'message' => 'Erreur interne du serveur',
                    'details' => config('app.debug') ? $e->getMessage() : null,
                ], 500);
            }
        });
    })->create();
