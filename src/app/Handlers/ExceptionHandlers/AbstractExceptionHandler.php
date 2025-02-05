<?php

namespace App\Handlers\ExceptionHandlers;

use App\Contracts\Handlers\ExceptionHandler;
use Illuminate\Http\JsonResponse;

abstract class AbstractExceptionHandler implements ExceptionHandler
{
    protected string $message = 'server_error';

    protected int $code = 500;

    public function handle(): JsonResponse
    {
        return response()->json([
            'message' => $this->message ?? '',
        ], $this->code ?? '');
    }
}
