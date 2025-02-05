<?php

namespace App\Services\ExternalResources\MetMuseum;

use App\Contracts\MetMuseum\MetMuseumServiceInterface;
use App\DTO\MetMuseum\MetMuseumDTOInterface;
use App\DTO\MetMuseum\SearchDTO;
use App\Exceptions\MetMuseumException;
use Exception;
use Illuminate\Support\Facades\Log;

class MetMuseumService implements MetMuseumServiceInterface
{
    public function __construct(protected MetMuseumAPIClient $apiClient)
    {
    }

    private function request(string $endpoint, string $method = 'get', ?MetMuseumDTOInterface $notificationDTO = null): object
    {
        try {
            Log::info('Make request to MetMuseum API', [
                'endpoint' => $endpoint,
                'method' => $method,
                'data' => $notificationDTO ? $notificationDTO->toArray() : null
            ]);
            $response = $this->apiClient->request($method, $endpoint, $notificationDTO ? $notificationDTO->toArray() : []);

            if ($response->getStatusCode() !== 200) {
                Log::error('MetMuseum API returned error', ['error' => $response->getBody()->getContents()]);
                throw new MetMuseumException('MetMuseum API returned an error: ' . $response->getBody()->getContents(), 500);
            }

            $responseContent = json_decode($response->getBody()->getContents());

            Log::info('MetMuseum API returned response', [
                'endpoint' => $endpoint,
                'method' => $method,
                'data' => $notificationDTO ? $notificationDTO->toArray() : null
            ]);
            return $responseContent;
        } catch (Exception $e) {
            $errorCode = $e->getCode();

            Log::error('Failed to request ' . $endpoint, [
                'endpoint' => $endpoint,
                'method' => $method,
                'data' => $notificationDTO ? $notificationDTO->toArray() : null,
                'code' => $errorCode,
                'message' => $e->getMessage()
            ]);

            throw $e;
        }
    }

    public function getDepartments(): object
    {
        return $this->request( 'public/collection/v1/departments');
    }

    public function search(SearchDTO $searchDTO): object
    {
        return $this->request('public/collection/v1/search', 'get', $searchDTO);
    }

        public function getObject(int $objectId): object
    {
        return $this->request('public/collection/v1/objects/' . $objectId);
    }
}
