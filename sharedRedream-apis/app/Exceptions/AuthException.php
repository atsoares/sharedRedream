<?php

namespace App\Exceptions;

use App\Exceptions\Traits\ExceptionResponseTrait;
use Illuminate\Http\Response;
use Exception;

class AuthException extends Exception
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
        return $this->errorResponse("This action is not allowed", Response::HTTP_FORBIDDEN);
    }
}
