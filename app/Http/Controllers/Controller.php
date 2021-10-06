<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function jsonSuccess(array $body = []): JsonResponse
    {
        $data = [
            'status' => 'success'
        ];

        return response()->json(array_merge($data, $body));
    }

    protected function jsonError(string $message, array $body = [], int $statusCode = 500): JsonResponse
    {
        $data = [
            'status' => 'error',
            'message' => $message,
        ];

        return response()->json(array_merge($data, $body), $statusCode);
    }
}
