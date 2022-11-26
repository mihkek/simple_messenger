<?php

namespace App\Services\Api\Standartisation;

use App\Contracts\Interfaces\IBaseApiResponseService;
use Illuminate\Http\JsonResponse;

class JsonApiResponceService implements IBaseApiResponseService
{
    public function sendResponse(mixed $data, string $message = '', int $status = 200): JsonResponse
    {
        $response = [
            'data'    => $data,
            'status' => $status,
        ];

        if ($message) {
            $response['message'] = $message;
        }

        return response()->json($response, $status);
    }
    public function sendError(mixed $data, string $message = '', int $status = 500): JsonResponse
    {
        $response = [
            'errors' => $data,
            'status' => $status,
        ];
        if ($message) {
            $response['message'] = $message;
        }

        return response()->json($response, $status);
    }
}
