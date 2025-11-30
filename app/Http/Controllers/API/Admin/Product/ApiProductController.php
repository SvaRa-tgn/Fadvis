<?php

namespace App\Http\Controllers\API\Admin\Product;

use App\Actions\API\Admin\Color\ApiCreateColorAction;
use App\Actions\API\Admin\Color\ApiUpdateColorAction;
use App\Actions\API\Admin\Product\ApiCreateProductAction;
use App\Actions\API\Admin\Product\ApiUpdateProductAction;
use App\Http\Requests\Admin\Color\CreateColorRequest;
use App\Http\Requests\Admin\Color\UpdateColorRequest;
use App\Http\Requests\Admin\Product\CreateProductRequest;
use App\Http\Requests\Admin\Product\UpdateProductRequest;
use Exception;
use Illuminate\Http\JsonResponse;

class ApiProductController
{
    /**
     * @param CreateProductRequest $request
     * @param ApiCreateProductAction $action
     * @return JsonResponse
     * @throws Exception
     */
    public function create(CreateProductRequest $request, ApiCreateProductAction $action): JsonResponse
    {
        return $action->execute($request->getDto());
    }

    /** @throws Exception */
    public function update(UpdateProductRequest $request, ApiUpdateProductAction $action): JsonResponse
    {
        return $action->execute($request->getDto());
    }
}
