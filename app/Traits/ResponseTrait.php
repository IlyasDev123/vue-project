<?php

namespace App\Traits;


trait ResponseTrait
{
    public function sendSuccess($message, $data, $statusCode = 200)
    {
        return response()->json(
            [
                'status' => true,
                'message' => $message,
                'data' => $data,
            ],
            $statusCode
        );
    }

    public function sendError($message, $data = null, $statusCode = 400)
    {
        return response()->json(
            [
                'status' => false,
                'message' => $message,
                'data' => $data
            ],
            $statusCode
        );
    }
}
