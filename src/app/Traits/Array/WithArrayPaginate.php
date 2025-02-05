<?php

namespace App\Traits\Array;

trait WithArrayPaginate
{
    private function paginateData(array $data, int $currentPage, int $pageSize): array
    {
        $totalItems = count($data);
        $totalPages = ceil($totalItems / $pageSize);

        $startIndex = ($currentPage - 1) * $pageSize;

        $paginatedData = array_slice($data, $startIndex, $pageSize);

        return [
            'data' => $paginatedData,
            'pagination' => [
                'total' => $totalItems,
                'count' => count($paginatedData),
                'currentPage' => $currentPage,
                'totalPages' => $totalPages,
                'pageSize' => $pageSize,
            ],
        ];
    }
}
