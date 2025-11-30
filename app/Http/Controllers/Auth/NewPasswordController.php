<?php

namespace App\Http\Controllers\Auth;

use App\Actions\WEB\Auth\NewPasswordAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NewPasswordController
{
    /**
     * @param NewPasswordAction $action
     * @param Request $request
     * @return JsonResponse
     */
    public function newPassword(NewPasswordAction $action, Request $request): JsonResponse
    {
        return $action->execute($request);
    }
}
