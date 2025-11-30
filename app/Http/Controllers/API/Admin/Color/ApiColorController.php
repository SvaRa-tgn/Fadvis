<?php

namespace App\Http\Controllers\API\Admin\Color;

use App\Actions\API\Admin\Color\ApiCreateColorAction;
use App\Actions\API\Admin\Color\ApiUpdateColorAction;
use App\Http\Requests\Admin\Color\CreateColorRequest;
use App\Http\Requests\Admin\Color\UpdateColorRequest;
use Exception;
use Illuminate\Http\JsonResponse;

class ApiColorController
{
    /**
     * @param CreateColorRequest $request
     * @param ApiCreateColorAction $action
     * @return JsonResponse
     * @throws Exception
     */
    public function create(CreateColorRequest $request, ApiCreateColorAction $action): JsonResponse
    {
        return $action->execute($request->getDto());
    }

    /** @throws Exception */
    public function update(UpdateColorRequest $request, ApiUpdateColorAction $action): JsonResponse
    {
        return $action->execute($request->getDto());
    }
}
