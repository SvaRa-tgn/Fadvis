<?php

namespace App\Http\Controllers\API\Profile;

use App\Actions\API\Profile\ApiCreatePatientAction;
use App\Actions\API\Profile\ApiUpdatePatientAction;
use App\Http\Requests\Profile\Patient\CreatePatientRequest;
use App\Http\Requests\Profile\Patient\UpdatePatientRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;

class ApiPatientController
{
    /**
     * @param CreatePatientRequest $request
     * @param ApiCreatePatientAction $action
     * @param User $user
     * @return JsonResponse
     * @throws Exception
     */
    public function create(CreatePatientRequest $request, ApiCreatePatientAction $action, User $user): JsonResponse
    {
        return $action->execute($request->getDto(), $user);
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
