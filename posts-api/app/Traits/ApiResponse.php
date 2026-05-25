<?php

namespace App\Traits;

trait ApiResponse
{
    protected function successResponse(mixed $data = null, string $message = 'Operation successful', int $status = 200)
    {
        $payloadData = $data ?? (object) [];

        return response()->json([
            'success' => true,
            'data' => $payloadData,
            'message' => $message,
        ], $status);
    }

    protected function errorResponse(string $message, array $errors = [], int $status = 400)
    {
        $payloadErrors = empty($errors) ? (object) [] : $errors;

        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $payloadErrors,
        ], $status);
    }
}
