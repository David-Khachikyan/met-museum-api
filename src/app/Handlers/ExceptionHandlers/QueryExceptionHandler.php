<?php

namespace App\Handlers\ExceptionHandlers;

class QueryExceptionHandler extends AbstractExceptionHandler
{
    protected string $message = 'server_error';

    protected int $code = 500;
}
