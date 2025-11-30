<?php

namespace App\Http\Controllers\Auth;

use App\Actions\WEB\Auth\RecoveryRequestAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RecoveryRequestController
{
    /**
     * @param RecoveryRequestAction $action
     * @param Request $request
     * @return JsonResponse
     */
    public function recovery(RecoveryRequestAction $action, Request $request): JsonResponse
    {
        return $action->execute($request);
    }
}
