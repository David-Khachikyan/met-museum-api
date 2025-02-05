<?php

namespace App\Http\Controllers\API\V1;

use App\Actions\MetMuseum\GetDepartmentsAction;
use App\Actions\MetMuseum\SearchAction;
use App\DTO\SearchRequestDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\MetMuseum\ObjectCollection;
use App\Http\Resources\MetMuseum\DepartmentResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * @OA\Info(
 *    title="Documentation",
 *    version="1.0.0",
 * )
 */
class MetMuseumController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/departments",
     *     tags={"Met museum"},
     *     summary="Get departments list",
     *
     *     @OA\Header(
     *          header="Accept",
     *          description="Accept application/json",
     *
     *          @OA\Schema(
     *             type="string",
     *              default="application/json"
     *           )
     *       ),
     *
     *     @OA\Response(
     *       response=200,
     *       description="Success",
     *        @OA\JsonContent(allOf={
     *           @OA\Schema(ref="#/components/schemas/DepartmentResource"),
     *        })
     *    ),
     *
     *    @OA\Response(
     *       response=500,
     *       description="Failed to get departments",
     *       @OA\JsonContent(
     *           @OA\Property(
     *              property="message",
     *              type="string",
     *              example="failed_get_departments"
     *           )
     *       )
     *     ),
     * )
     */
    public function getDepartments(GetDepartmentsAction $getDepartmentsAction): ResourceCollection
    {
        $departments = $getDepartmentsAction();

        return DepartmentResource::collection($departments->departments);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/search",
     *     tags={"Met museum"},
     *     summary="Search objects by keywords",
     *     description="Search objects in the Met Museum collection using keywords and filters.",
     *
     *     @OA\Header(
     *          header="Accept",
     *          description="Accept application/json",
     *          @OA\Schema(type="string", default="application/json")
     *      ),
     *
     *     @OA\Parameter(
     *         name="q",
     *         in="query",
     *         required=true,
     *         description="Search query (keyword to search objects)",
     *         @OA\Schema(type="string", example="Van Gogh")
     *     ),
     *     @OA\Parameter(
     *         name="perPage",
     *         in="query",
     *         required=false,
     *         description="Number of results per page",
     *         @OA\Schema(type="integer", example=10)
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         required=false,
     *         description="Page number for pagination",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Parameter(
     *         name="departmentId",
     *         in="query",
     *         required=false,
     *         description="Filter results by department ID",
     *         @OA\Schema(type="integer", example=12)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful search",
     *         @OA\JsonContent(ref="#/components/schemas/ObjectCollection")
     *     ),
     *
     *     @OA\Response(
     *         response=500,
     *         description="Failed to search objects",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="failed_search_objects"
     *             )
     *         )
     *     )
     * )
     */
    public function search(SearchRequest $request, SearchAction $searchAction): ObjectCollection
    {
        $result = $searchAction(SearchRequestDTO::init($request->validated()));

        return ObjectCollection::make($result);
    }
}
