<?php

namespace App\Actions\MetMuseum;

use App\DTO\MetMuseum\SearchDTO;
use App\DTO\SearchRequestDTO;
use App\Services\ExternalResources\MetMuseum\MetMuseumService;
use App\Traits\Array\WithArrayPaginate;
use Exception;
use Illuminate\Support\Facades\Log;

class SearchAction
{
    use WithArrayPaginate;

    public function __construct(private MetMuseumService $metMuseumService, private GetObjectAction $getObjectAction)
    {
    }

    public function __invoke(SearchRequestDTO $searchRequestDTO): array
    {
        Log::info('Start execution of SearchAction');
        try {
            $searchResult = $this->metMuseumService->search(SearchDTO::init([
                'term' => $searchRequestDTO->getTerm(),
                'departmentId' => $searchRequestDTO->getDepartmentId(),
            ]));

            $paginated = $this->paginateData(
                $searchResult->objectIDs ?? [],
                $searchRequestDTO->getPage(),
                $searchRequestDTO->getPerPage(),
            );

            $objects = collect($paginated['data'])->map(function ($objectId) {
                return ($this->getObjectAction)($objectId);
            })->toArray();

            $paginated['data'] = $objects;

            Log::info('Successfully done execution of SearchAction');
            return $paginated;
        } catch (Exception $e) {
            Log::error('Error in execution of SearchAction', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            throw new Exception('failed_search_objects');
        }
    }
}