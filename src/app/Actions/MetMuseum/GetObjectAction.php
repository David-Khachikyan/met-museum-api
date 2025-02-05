<?php

namespace App\Actions\MetMuseum;

use App\Services\ExternalResources\MetMuseum\MetMuseumService;
use Exception;
use Illuminate\Support\Facades\Log;

class GetObjectAction
{
    public function __construct(private MetMuseumService $metMuseumService)
    {
    }

    public function __invoke(int $objectId)
    {
        Log::info('Start execution of GetObjectAction', ['objectId' => $objectId]);
        try {
            $object = $this->metMuseumService->getObject($objectId);

            Log::info('Successfully done execution of GetObjectAction', ['objectId' => $objectId]);
            return $object;
        } catch (Exception $e) {
            Log::error('Error in execution of GetObjectAction', [
                'objectId' => $objectId,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            throw new Exception('failed_get_object');
        }
    }
}