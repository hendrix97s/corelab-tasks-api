<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

return Application::configure(basePath: dirname(__DIR__))
  ->withRouting(
    commands: __DIR__ . '/../routes/console.php',
    health: '/up',
    using: function () {
      Route::middleware('api', 'auth:sanctum')
        ->prefix('api')
        ->group(base_path('routes/api.php'));

      Route::middleware('api', 'web')
        // ->prefix('api')
        ->group(base_path('routes/auth.php'));

      Route::middleware('web')
        ->group(base_path('routes/web.php'));


      RateLimiter::for('api', function (Request $request) {
        return Limit::perMinute(300)->by(optional($request->user())->id ?: $request->ip());
      });
    }
  )
  ->withMiddleware(function (Middleware $middleware) {
    $middleware->api(prepend: [\Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,]);
    $middleware->alias(['verified' => \App\Http\Middleware\EnsureEmailIsVerified::class,]);
    $middleware->validateCsrfTokens(except: ['*', 'api/*',]);
  })
  ->withExceptions(function (Exceptions $exceptions) {
    $exceptions->render(function (ValidationException $e, $request) {
      if ($e instanceof ValidationException)
        return response()->json([
          "status"   => false,
          "messages" => __('validation.error_validation'),
          "data"     => $e->validator->errors()->getMessages(),
        ], 400);

      return $e->response;
    });
  })->create();
