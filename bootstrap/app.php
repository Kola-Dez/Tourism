<?php

use App\Http\Middleware\SetLocale;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        apiPrefix: 'api/v1',
    )
    ->withMiddleware(function ($middleware) {
        $middleware->api(SetLocale::class);
        $middleware->statefulApi();
        $middleware->web();
    })
    ->withExceptions(function ($exceptions) {
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            if ($request->wantsJson()) {
                return new JsonResponse([
                    'status' => 401,
                    'error' => 'unauthorized',
                    'message' => 'Unauthorized'
                ], 401);
            }

            // Для не-JSON запросов используем стандартный рендеринг
            return response()->view('errors.401', [], 401);
        });

        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->wantsJson()) {
                return new JsonResponse([
                    'status' => 401,
                    'error' => 'not_found',
                    'message' => 'Not found'
                ], 404);
            }

            // Для не-JSON запросов используем стандартный рендеринг
            return response()->view('errors.404', [], 404);
        });
    })->create();
