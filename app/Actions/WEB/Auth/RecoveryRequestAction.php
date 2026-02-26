<?php

namespace App\Actions\WEB\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class RecoveryRequestAction
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function execute(Request $request): JsonResponse
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? response()->json(
                data: [
                    'message' => [
                        'status'  => __($status),
                        'message' => 'Письмо с инструкциями по сбросу пароля отправлены на вашу почту',
                    ],
                ],
            )
            : response()->json(['text' => __($status)], 422);
    }

}
