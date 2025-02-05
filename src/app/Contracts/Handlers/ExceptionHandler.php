<?php

namespace App\Contracts\Handlers;

use Illuminate\Http\JsonResponse;

interface ExceptionHandler
{
    public function handle(): JsonResponse;
}
