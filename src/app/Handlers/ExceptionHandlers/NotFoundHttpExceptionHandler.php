<?php

namespace App\Handlers\ExceptionHandlers;

class NotFoundHttpExceptionHandler extends AbstractExceptionHandler
{
    protected string $message = 'not_found';

    protected int $code = 404;
}
