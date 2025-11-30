<?php

namespace App\Http\Controllers\API\Profile;

use App\Actions\API\Profile\ApiUpdatePatientAction;
use App\Actions\API\Profile\Order\ApiCreateOrderAction;
use App\Http\Requests\Profile\Order\CreateOrderRequest;
use App\Http\Requests\Profile\Patient\UpdatePatientRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;

class ApiOrderController
{
    /**
     * @param CreateOrderRequest $request
     * @param ApiCreateOrderAction $action
     * @param User $user
     * @return JsonResponse
     * @throws Exception
     */
    public function create(CreateOrderRequest $request, ApiCreateOrderAction $action, User $user): JsonResponse
    {
        return $action->execute($request->getDto(), $user);
    }

    public function createItem()
    {

    }

    /**
     * @param UpdatePatientRequest $request
     * @param ApiUpdatePatientAction $action
     * @param User $user
     * @return JsonResponse
     * @throws Exception
     */
    public function update(UpdatePatientRequest $request, ApiUpdatePatientAction $action, User $user): JsonResponse
    {
        return $action->execute($request->getDto(), $user);
    }
}
