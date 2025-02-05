<?php

namespace App\Services\ExternalResources;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

abstract class AbstractAPIClient
{
    protected PendingRequest $httpClient;
    protected string $type;

    protected function getServerMacro($type): PendingRequest
    {
        return Http::{$type}();
    }
}
