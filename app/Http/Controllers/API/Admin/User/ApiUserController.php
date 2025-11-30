<?php

namespace App\Http\Controllers\API\Admin\User;

use App\Actions\API\Admin\User\ApiCreateUserAction;
use App\Actions\API\Admin\User\ApiUpdateUserAction;
use App\Actions\API\Admin\User\ChangePasswordAction;
use App\Http\Requests\Admin\User\ChangePasswordRequest;
use App\Http\Requests\Admin\User\CreateUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use Exception;
use Illuminate\Http\JsonResponse;

class ApiUserController
{
    /** Создание владельца сайта
     *
     * @throws Exception
     */
    public function create(CreateUserRequest $request, ApiCreateUserAction $action): JsonResponse
    {
        return $action->execute($request->getDto());
    }

    /** @throws Exception */
    public function update(UpdateUserRequest $request, ApiUpdateUserAction $action): JsonResponse
    {
        return $action->execute($request->getDto());
    }

    /** @throws Exception */
    public function changePassword(ChangePasswordRequest $request, ChangePasswordAction $action): JsonResponse
    {
        return $action->execute($request->getDto());
    }
}
