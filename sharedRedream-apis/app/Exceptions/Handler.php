<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use App\Exceptions\Traits\ExceptionResponseTrait;
use Throwable;

class Handler extends ExceptionHandler
{
    use ExceptionResponseTrait;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->reportable(function (HttpException $e) {
            $code = $e->getStatusCode();
            $defaultMessage = Response::$statusTexts[$code];
            $message = $e->getMessage() == "" ? $defaultMessage : $e->getMessage();
            return $this->errorResponse($message, $code);
        });

        $this->reportable(function (ValidationException $e) {
            $errors = $e->validator->errors()->getMessages();
            return $this->errorResponse($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        });

        $this->reportable(function (NotEnoughtBalanceException $e) {
            return $this->errorResponse("Balance is not enought", Response::HTTP_UNPROCESSABLE_ENTITY);
        });

        $this->reportable(function (AuthorizationException $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_FORBIDDEN);
        });

        $this->reportable(function (AuthenticationException $e) {
            return $this->errorResponse("Balance is not enought", Response::HTTP_UNPROCESSABLE_ENTITY);
        });
    }

}
