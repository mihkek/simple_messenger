<?php

namespace App\Contracts\Interfaces;

use Illuminate\Http\JsonResponse;

interface IBaseApiResponseService
{
    public function sendResponse(mixed $data, string $message = '', int $status = 200): JsonResponse;
    public function sendError(mixed $data, string $message = '', int $status = 500): JsonResponse;
}
