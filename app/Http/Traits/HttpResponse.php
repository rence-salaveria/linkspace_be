<?php

namespace App\Http\Traits;

use App\Enums\HttpStatus;

trait HttpResponse
{
    public function success($data, $message, $code = HttpStatus::OK): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => "Request successful",
            'message' => $message,
            'payload' => $data,
            'requestTime' => now()
        ], $code->value);
    }

    protected function error($message, HttpStatus $code): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => $message,
        ], $code->value);
    }
}
