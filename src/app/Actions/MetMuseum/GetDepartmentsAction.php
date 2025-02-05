<?php

namespace App\Actions\MetMuseum;

use App\Services\ExternalResources\MetMuseum\MetMuseumService;
use Exception;
use Illuminate\Support\Facades\Log;

class GetDepartmentsAction
{
    public function __construct(private MetMuseumService $metMuseumService)
    {
    }

    public function __invoke()
    {
        Log::info('Start execution of GetDepartmentsAction');
        try {
            $departments = $this->metMuseumService->getDepartments();

            Log::info('Successfully done execution of GetDepartmentsAction');
            return $departments;
        } catch (Exception $e) {
            Log::error('Error in execution of GetDepartmentsAction', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            throw new Exception('failed_get_departments');
        }
    }
}