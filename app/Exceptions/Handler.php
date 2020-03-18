<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Throwable $exception)
    {
        Log::error('Exception Be Catched in Handler: '. $exception->getMessage() ." Traceback Info: ".$exception->getTraceAsString());
        if($this->isHttpException($exception)) {
            // 403
            if($exception->getStatusCode() == 403) {
                return response()->view('errors.403');
            }
            // 404
            if($exception->getStatusCode() == 404) {
                return response()->view('errors.404');
            }
            // 500
            return response()->view('errors.500');
        }
        return parent::render($request, $exception);
    }
}
