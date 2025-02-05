<?php

namespace App\Handlers\ExceptionHandlers;

use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class BadRequestExceptionHandler extends AbstractExceptionHandler
{
    protected string $message;

    protected int $code = 400;

    protected BadRequestException $exception;

    public function __construct(BadRequestException $exception)
    {
        $this->exception = $exception;
        $this->setMessage();
    }

    protected function setMessage(): void
    {
        $this->message = $this->exception->getMessage() ?? 'bad_request';
    }
}
