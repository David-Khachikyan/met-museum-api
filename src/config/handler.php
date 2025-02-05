<?php

use App\Exceptions\MetMuseumException;
use App\Handlers\ExceptionHandlers\BadRequestExceptionHandler;
use App\Handlers\ExceptionHandlers\ModelNotFoundExceptionHandler;
use App\Handlers\ExceptionHandlers\NotFoundHttpExceptionHandler;
use App\Handlers\ExceptionHandlers\MetMuseumExceptionHandler;
use App\Handlers\ExceptionHandlers\QueryExceptionHandler;
use App\Handlers\ExceptionHandlers\ValidationExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return [

    'bindings' => [
        NotFoundHttpException::class => NotFoundHttpExceptionHandler::class,
        ModelNotFoundException::class => ModelNotFoundExceptionHandler::class,
        ValidationException::class => ValidationExceptionHandler::class,
        QueryException::class => QueryExceptionHandler::class,
        MetMuseumException::class => MetMuseumExceptionHandler::class,
        BadRequestException::class => BadRequestExceptionHandler::class,
    ],

    /**
     * List of environments in which we do not need to hide the trace.
     */
    'excluded_environments' => [
        'local',
    ],
];
