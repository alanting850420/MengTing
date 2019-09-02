<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        '\App\Exceptions\InputException',
        '\App\Exceptions\SqlException',
        '\App\Exceptions\RedisException',
        '\App\Exceptions\PassException',
        '\App\Exceptions\Encrypt104Exception',
        '\App\Exceptions\SwaggerException',
        '\App\Exceptions\AccessException',
        '\App\Exceptions\TestPathException',
        '\App\Exceptions\TokenException',
        '\App\Exceptions\ApiAccessException',
        '\App\Exceptions\ApiKeyAccessException',
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
    ];

    /**
     * Report or log an exception.
     *
     * @param \Exception $exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception               $exception
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {

        if ($exception instanceof SqlException) {
            $reponse['errorMsg'] = $exception->getMessage();
            if (config('app.debug')) {
                $reponse['errorSql'] = $exception->getQuery();
            }

            return response()->json(
                $reponse,
                500
            );
        }

        if (config('app.debug')) {
            return parent::render($request, $exception);
        } else {
            return response()->json(
                [
                    'errorMsg' => $exception->getMessage(),
                ],
                500
            );
        }
    }
}
