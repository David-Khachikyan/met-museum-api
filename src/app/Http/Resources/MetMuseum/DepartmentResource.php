<?php

namespace App\Http\Resources\MetMuseum;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


/**
 * @OA\Schema(
 *  schema="DepartmentResource",
 *  title="Department Resource",
 *  description="Resource representing a department",
 *
 *  @OA\Property(
 *      property="id",
 *      type="integer",
 *      description="Department ID",
 *      example=1
 *   ),
 *  @OA\Property(
 *      property="name",
 *      type="string",
 *      description="Department Name",
 *      example="European Paintings"
 *   )
 * )
 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
 */
class DepartmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->departmentId,
            'name' => $this->resource->displayName,
        ];
    }
}
