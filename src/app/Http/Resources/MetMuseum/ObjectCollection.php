<?php

namespace App\Http\Resources\MetMuseum;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *  schema="ObjectCollection",
 *  title="ObjectCollectionResource",
 *
 *  @OA\Property(
 *      property="total",
 *      type="integer",
 *      description="Total number of objects",
 *      example=15
 *  ),
 *  @OA\Property(
 *      property="count",
 *      type="integer",
 *      description="Number of objects returned on the current page",
 *      example=10
 *  ),
 *  @OA\Property(
 *      property="pageSize",
 *      type="integer",
 *      description="Number of objects per page",
 *      example=10
 *  ),
 *  @OA\Property(
 *      property="currentPage",
 *      type="integer",
 *      description="Current page number",
 *      example=1
 *  ),
 *  @OA\Property(
 *      property="totalPages",
 *      type="integer",
 *      description="Total number of pages",
 *      example=2
 *  ),
 *  @OA\Property(
 *      property="data",
 *      type="array",
 *      description="List of objects",
 *      @OA\Items(ref="#/components/schemas/ObjectResource")
 *  )
 * )
 */
class ObjectCollection extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'total' => $this->resource['pagination']['total'],
            'count' => $this->resource['pagination']['count'],
            'perPage' => $this->resource['pagination']['pageSize'],
            'currentPage' => $this->resource['pagination']['currentPage'],
            'totalPages' => $this->resource['pagination']['totalPages'],
            'data' => ObjectResource::collection($this->resource['data']),
        ];
    }
}
