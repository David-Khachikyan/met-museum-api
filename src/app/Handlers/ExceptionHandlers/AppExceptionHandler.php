<?php

namespace App\Handlers\ExceptionHandlers;

use Throwable;

class AppExceptionHandler extends AbstractExceptionHandler
{
    private Throwable $exception;

    protected string $message = '';

    protected int $code = 500;

    public function __construct(Throwable $exception)
    {
        $this->exception = $exception;
        $this->setMessage();
        $this->setCode();
    }

    protected function setMessage(): void
    {
        $this->message = $this->exception->getMessage() ?? '';
    }

    protected function setCode(): void
    {
        $this->code = $this->statusCode();
    }

    protected function statusCode(): int
    {
        $exceptionCode = $this->exception->getCode();
        if ($exceptionCode) {
            return $exceptionCode;
        }

        if (method_exists($this->exception, 'getStatusCode')) {
            $statusCode = $this->exception->getStatusCode();
            if ($statusCode) {
                return $statusCode;
            }
        }

        return $this->code;
    }
}
