<?php

namespace App\Http\Controllers\API\Admin\Product;

use App\Actions\API\Admin\Color\ApiCreateColorAction;
use App\Actions\API\Admin\Color\ApiUpdateColorAction;
use App\Actions\API\Admin\Product\ApiCreateProductAction;
use App\Actions\API\Admin\Product\ApiUpdateProductAction;
use App\Exceptions\BadRequestException;
use App\Exceptions\CreateModelException;
use App\Http\Requests\Admin\Color\CreateColorRequest;
use App\Http\Requests\Admin\Color\UpdateColorRequest;
use App\Http\Requests\Admin\Product\CreateProductRequest;
use App\Http\Requests\Admin\Product\UpdateProductRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Throwable;

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

    /**
     * @param UpdateProductRequest $request
     * @param ApiUpdateProductAction $action
     * @return JsonResponse
     * @throws BadRequestException|CreateModelException|Throwable
     */
    public function update(UpdateProductRequest $request, ApiUpdateProductAction $action): JsonResponse
    {
        return $action->execute($request->getDto());
    }
}
