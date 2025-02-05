<?php

namespace App\Handlers;

use App\Contracts\Handlers\ExceptionHandler;
use App\Handlers\ExceptionHandlers\AppExceptionHandler;
use Throwable;

class ExceptionHandlerFactory
{
    public static function make(Throwable $exception): ExceptionHandler
    {
        $className = get_class($exception);
        $exceptionBindings = config('handler.bindings');

        if (array_key_exists($className, $exceptionBindings)) {
            return new $exceptionBindings[$className]($exception);
        }

        return new AppExceptionHandler($exception);
    }
}
