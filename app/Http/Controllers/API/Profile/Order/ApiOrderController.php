<?php

namespace App\Http\Controllers\API\Profile\Order;

use App\Actions\API\Profile\Order\ApiCreateOrderAction;
use App\Exceptions\ErrorException;
use App\Http\Requests\Profile\Order\CreateOrderRequest;
use Illuminate\Http\JsonResponse;
use Random\RandomException;
use Throwable;

class ApiOrderController
{
    /**
     * @param CreateOrderRequest $request
     * @param ApiCreateOrderAction $action
     * @return JsonResponse
     * @throws ErrorException|RandomException|Throwable
     */
    public function create(CreateOrderRequest $request, ApiCreateOrderAction $action): JsonResponse
    {
        return $action->execute($request->getDto());
    }
}
