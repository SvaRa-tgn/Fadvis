<?php

namespace App\Http\Controllers\API\RegistrationMaster;

use App\Actions\API\Admin\User\ApiCreateUserAction;
use App\Http\Requests\Admin\User\CreateUserRequest;
use Exception;
use Illuminate\Http\JsonResponse;

class ApiRegistrationMasterController
{
    /** Создание владельца сайта
     *
     * @throws Exception
     */
    public function create(CreateUserRequest $request, ApiCreateUserAction $action): JsonResponse
    {
        return $action->execute($request->getDto());
    }
}
