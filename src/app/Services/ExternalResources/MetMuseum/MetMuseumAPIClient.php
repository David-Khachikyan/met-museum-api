<?php

namespace App\Services\ExternalResources\MetMuseum;

use App\Services\ExternalResources\AbstractAPIClient;


class MetMuseumAPIClient extends AbstractAPIClient
{
    protected array $headers = [];

    public function __construct()
    {
        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];

        $this->httpClient = $this->getServerMacro('metMuseum')->withHeaders($headers);
    }

    public function request(string $method, string $uri, array $data = [])
    {
        return $this->httpClient->$method($uri, $data);
    }
}
