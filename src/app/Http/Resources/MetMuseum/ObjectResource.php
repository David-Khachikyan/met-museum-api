<?php

namespace App\Http\Resources\MetMuseum;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *  schema="ObjectResource",
 *  title="Object Resource",
 *  description="Met Museum object details",
 *
 *  @OA\Property(
 *      property="id",
 *      type="integer",
 *      description="Object ID",
 *      example=12345
 *  ),
 *  @OA\Property(
 *      property="image",
 *      type="string",
 *      nullable=true,
 *      description="Primary image URL",
 *      example="https://www.metmuseum.org/art/collection/image/12345.jpg"
 *  ),
 *  @OA\Property(
 *      property="department",
 *      type="string",
 *      nullable=true,
 *      description="Department name",
 *      example="European Paintings"
 *  ),
 *  @OA\Property(
 *      property="objectName",
 *      type="string",
 *      nullable=true,
 *      description="Object name",
 *      example="Oil Painting"
 *  ),
 *  @OA\Property(
 *      property="title",
 *      type="string",
 *      description="Title of the object",
 *      example="The Starry Night"
 *  ),
 *  @OA\Property(
 *      property="objectUrl",
 *      type="string",
 *      nullable=true,
 *      description="Object URL on the Met Museum website",
 *      example="https://www.metmuseum.org/art/collection/search/12345"
 *  ),
 *  @OA\Property(
 *      property="objectWikidataUrl",
 *      type="string",
 *      nullable=true,
 *      description="Wikidata URL for the object",
 *      example="https://www.wikidata.org/wiki/Q12345"
 *  )
 * )
 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
 */
class ObjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->objectID,
            'image' => $this->resource->primaryImage ?? null,
            'department' => $this->resource->department ?? null,
            'objectName' => $this->resource->objectName ?? null,
            'title' => $this->resource->title,
            'objectUrl' => $this->resource->objectURL ?? null,
            'objectWikidataUrl' => $this->resource->objectWikidata_URL ?? null,
        ];
    }
}
