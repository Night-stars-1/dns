<?php
/*
 * @Date: 2024-02-05 22:55:02
 * @LastEditors: Night-stars-1 nujj1042633805@gmail.com
 * @LastEditTime: 2024-02-08 20:14:02
 */

namespace App\Exceptions;

use App\Helper;
use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Log;
use Swift_TransportException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use TheSeer\Tokenizer\TokenCollectionException;

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
     * @param  \Throwable $exception
     * @return void
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Throwable $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof NotFoundHttpException) {
            return $this->response($request, 404, '页面不存在');
        } elseif ($exception instanceof HttpException) {
            if ($exception->getStatusCode() === 405) {
                Log::debug( 'MethodNotAllowedHttpException: ' . $exception );
                return $this->response($request, $exception->getStatusCode(), 'MethodNotAllowedHttpException');
            } else {
                return $this->response($request, $exception->getStatusCode(), $exception->getMessage());
            }
        } elseif ($exception instanceof Swift_TransportException) {
            return $this->response($request, 500, $exception->getMessage());
        } elseif ($exception instanceof TokenCollectionException || $exception instanceof TokenMismatchException) {
            return $this->response($request, 419, "页面过期，请刷新后再试！");
        }
        return parent::render($request, $exception);
    }


    private function response(Request $request, int $status, string $message = null)
    {
        $message = explode('@', $message);
        $url = isset($message[1]) ? $message[1] : null;
        $message = $message[0];
        if ($status < 0) {
            return response()->json(['status' => $status, 'message' => $message], 200);
        }
        if (!Helper::isPjax() && ($request->isXmlHttpRequest() || strpos($request->path(), 'api/') === 0)) {
            return response()->json(['status' => $status, 'message' => $message], 200);
        } else {
            return response()->json(view('error')->with(['status' => $status, 'error' => $message, 'url' => $url]));
        }
    }
}
