<?php

namespace App\Handlers\ExceptionHandlers;

use App\Exceptions\MetMuseumException;

class MetMuseumExceptionHandler extends AbstractExceptionHandler
{
    protected string $message = 'server_error';
    protected int $code;
    protected MetMuseumException $exception;


    public function __construct(MetMuseumException $exception)
    {
        $this->exception = $exception;
        $this->code = $exception->getCode();
    }
}
