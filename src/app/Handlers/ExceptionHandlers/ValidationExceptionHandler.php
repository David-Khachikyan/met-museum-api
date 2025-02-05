<?php

namespace App\Handlers\ExceptionHandlers;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class ValidationExceptionHandler extends AbstractExceptionHandler
{
    protected int $code = 422;

    protected ValidationException $exception;

    public function __construct(ValidationException $exception)
    {
        $this->exception = $exception;
        $this->setMessage();
    }

    private function validationErrors(): array
    {
        return $this->exception->validator->errors()->messages();
    }

    protected function setMessage(): void
    {
        $this->message = $this->exception->getMessage() ?? 'validation_error';
    }

    public function handle(): JsonResponse
    {
        return response()->json([
            'message' => $this->message,
            'errors' => $this->validationErrors(),
        ], $this->code);
    }
}
