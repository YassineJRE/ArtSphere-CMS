<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Log;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (\Illuminate\Auth\AuthenticationException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => __('Unauthenticated'),
                ], Response::HTTP_UNAUTHORIZED);
            }
        });

        $this->renderable(function (\Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException $e) {
            Log::error($e->getMessage());

            return response()->json([
                'message' => __('Unauthenticated'),
            ], Response::HTTP_UNAUTHORIZED);
        });

        $this->renderable(function (\Spatie\Permission\Exceptions\UnauthorizedException $e, $request) {
            Log::error($e->getMessage());

            $middleware = $request->route() ? $request->route()->middleware() : [];

            if (collect($middleware)->contains('auth.admin')) {
                return response()->view('admin.errors.403',
                    [], Response::HTTP_FORBIDDEN);
            }

            if (collect($middleware)->contains('api')) {
                return response()->json([
                    'message' => __('User have not permission for this page access.'),
                ], Response::HTTP_FORBIDDEN);
            }

            return response()->view('errors.403',
                [], Response::HTTP_FORBIDDEN
            );
        });

        $this->renderable(function (\Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException $e, $request) {
            $middleware = $request->route() ? $request->route()->middleware() : [];

            if (collect($middleware)->contains('auth.admin')) {
                return response()->view('admin.errors.403',
                    [], Response::HTTP_FORBIDDEN);
            }

            if (collect($middleware)->contains('api')) {
                return response()->json([
                    'message' => __('This action is unauthorized'),
                ], Response::HTTP_FORBIDDEN);
            }

            return response()->view('errors.403',
                [], Response::HTTP_FORBIDDEN);
        });

        $this->renderable(function (\Illuminate\Routing\Exceptions\InvalidSignatureException $e, $request) {
            $middleware = $request->route() ? $request->route()->middleware() : [];

            if (collect($middleware)->contains('api')) {
                return response()->json([
                    'message' => __('403 Link expired'),
                ], Response::HTTP_FORBIDDEN);
            }

            if (collect($middleware)->contains('auth.admin')) {
                return response()->view('admin.errors.link-expired',
                    [], Response::HTTP_FORBIDDEN);
            }

            return response()->view('errors.link-expired',
                [], Response::HTTP_FORBIDDEN);
        });

        $this->renderable(function (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e, $request) {
            Log::error($e->getMessage());

            $middleware = $request->route() ? $request->route()->middleware() : [];

            if (collect($middleware)->contains('auth.admin')) {
                return response()->view('admin.errors.404',
                    [], Response::HTTP_NOT_FOUND);
            }

            if (collect($middleware)->contains('api')) {
                return response()->json([
                    'message' => __('Record not found'),
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->view('errors.404',
                [], Response::HTTP_NOT_FOUND);
        });

        $this->renderable(function (\Illuminate\Validation\ValidationException $e, $request) {
            $middleware = $request->route() ? $request->route()->middleware() : [];

            if (collect($middleware)->contains('api')) {
                return response()->json([
                    'message' => $e->getMessage(),
                    'errors' => $e->errors(),
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
        });

        $this->reportable(function (Throwable $e) {
        });

        $this->reportable(function (CommandException $e) {
            return false;
        });

        $this->reportable(function (ModelNotFoundException $e) {
            return false;
        });

        $this->reportable(function (RepositoryException $e) {
            return false;
        });

        $this->reportable(function (ServiceException $e) {
            Log::error($e);

            return false;
        });

        $this->renderable(function (Exception $e, $request) {
            Log::error($e);
            $middleware = $request->route() ? $request->route()->middleware() : [];

            if (collect($middleware)->contains('api')) {
                return response()->json([
                    'message' => 'Http Error 500 (Internal Server)',
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        });
    }
}
