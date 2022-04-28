<?php

namespace App\Exceptions\Traits;

use Illuminate\Http\Response;

trait ExceptionResponseTrait
{
    /**
     * Data Response
     * @param $data
     * @return Response
     */
    public function dataResponse($data)
    {
        return response()->json(['content' => $data], Response::HTTP_OK);
    }

    /**
     * Success Response
     * @param string $message
     * @param int $code
     * @return Response
     */
    public function successResponse(string $message, $code = Response::HTTP_OK)
    {
        return response()->json(['success' => $message, 'code' => $code], $code);
    }

    /**
     * Error Response
     * @param $message
     * @param int $code
     * @return Response
     *
     */
    public function errorResponse($message, $code = Response::HTTP_BAD_REQUEST)
    {
        return response()->json(['error' => $message, 'code' => $code], $code);
    }
}