<?php

namespace App\Actions\WEB\Auth;

use App\Mail\TempPassword;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class RecoveryRequestAction
{
    public function execute(Request $request): JsonResponse
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? response()->json([
                'status'  => __($status),
                'title'   => 'Инструкции отправлены',
                'message' => 'Письмо с инструкциями по сбросу пароля отправлены на вашу почту',
            ])
            : response()->json(['text' => __($status)], 422);
    }

}
