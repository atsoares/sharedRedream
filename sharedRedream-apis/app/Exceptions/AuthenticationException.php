<?php

namespace App\Exceptions;

use App\Exceptions\Traits\ExceptionResponseTrait;
use Illuminate\Http\Response;
use Exception;

class AuthenticationException extends Exception
{
    use ExceptionResponseTrait;

    /**
     * Render the exception into an HTTP response
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return $this->errorResponse("Wrong credentials", Response::HTTP_UNAUTHORIZED);
    }
}
