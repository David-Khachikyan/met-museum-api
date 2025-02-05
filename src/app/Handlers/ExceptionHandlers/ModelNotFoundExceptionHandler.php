<?php

namespace App\Handlers\ExceptionHandlers;

class ModelNotFoundExceptionHandler extends AbstractExceptionHandler
{
    protected string $message = 'not_found_model';

    protected int $code = 404;
}
