<?php

namespace solider\Exceptions;

use Asm89\Stack\CorsService;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use solider\Traits\ApiResponser;

class Handler extends ExceptionHandler
{
    use ApiResponser;
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
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        $response = $this->handleException($request, $exception);
        
        app(CorsService::class)->addActualRequestHeaders($response, $request);

        return $response;
    }

    public function handleException($request, Exception $exception)
    {
        // if token is invalid
        if ($exception instanceof TokenInvalidException) {
            return $this->errorResponse("invalid Token!." , 400);
        }
        if ($exception instanceof TokenExpiredException) {
            return $this->errorResponse("token expired!." , 400);
        }
        if ($exception instanceof JWTException) {
            return $this->errorResponse("token problem!." , 400);
        }
         // example: store user (post) with invalid attributes
        if ($exception instanceof ValidationException) {
            return $this->convertValidationExceptionToResponse($exception, $request);
        }
        // example: get user with not existing id
        if ($exception instanceof ModelNotFoundException) {
            // return $this->errorResponse($exception->getMessage(),404);

            $modelName = strtolower(class_basename($exception->getModel())); // solider\\User -> User -> user
            return $this->errorResponse("Does not exists any {$modelName} with the specified identificator!." , 404);
        }
        // if unautenticated
        if ($exception instanceof AuthenticationException) {
            return $this->unauthenticated($request, $exception);
        }
        // if not authorized
        if ($exception instanceof AuthorizationException) {
           return $this->errorResponse($exception->getMessage(), 403);
        }
        // if URL does not exist
        if ($exception instanceof NotFoundHttpException) {
           return $this->errorResponse('The specified URL could not be found!.', 404);
        }
        // if URL exisit but method is invalid(post, get, put, delete.....)
        if ($exception instanceof MethodNotAllowedHttpException) {
           return $this->errorResponse('The specified Method for the request is invalid!.', 405);
        }
        // for all other HttpException s
        if ($exception instanceof HttpException) {
           return $this->errorResponse($exception->getMessage(), $exception->getStatusCode());
        }
        //
         if ($exception instanceof QueryException) {
           $errorCode = $exception->errorInfo[1];
           if ($errorCode == 1451) {
                return $this->errorResponse('Cannont remove this resource permanently. It is related with another resource(s)!.', 409);
           }
        }
        // false token
        if ($exception instanceof TokenMismatchException) {
           return redirect()->back()->withInput($request->input()); 
        }


        if (config('app.debug')) {
            return parent::render($request, $exception);
        }

        return $this->errorResponse('Unexpected Exception. Try later!.', 500);
    }
     /**
     * Create a response object from the given validation exception.
     *
     * @param  \Illuminate\Validation\ValidationException  $e
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        // $error = $e->getMessage();// kurze error beschreibung
        $errors = $e->validator->errors()->messages();

        if ($this->isFrontend($request)) {
            return $request->ajax() ? response()->json($errors, 422) : redirect()->back()
                                                                                ->withInput($request->input())
                                                                                ->withErrors($errors);
        }

        return $this->errorResponse($errors, 422);
    }

    private function isFrontend($request)
    {
        return $request->acceptsHtml() && collect($request->route()->middleware())->contains('web');
    }
}
