<?php

namespace App\Http\Controllers\API\Admin\Category;

use App\Actions\API\Admin\Category\ApiCreateCategoryAction;
use App\Actions\API\Admin\Category\ApiUpdateCategoryAction;
use App\Http\Requests\Admin\Category\CreateCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use Exception;
use Illuminate\Http\JsonResponse;

class ApiCategoryController
{
    /** @throws Exception */
    public function create(CreateCategoryRequest $request, ApiCreateCategoryAction $action): JsonResponse
    {
        return $action->execute($request->getDto());
    }

    /** @throws Exception */
    public function update(UpdateCategoryRequest $request, ApiUpdateCategoryAction $action): JsonResponse
    {
        return $action->execute($request->getDto());
    }
}
