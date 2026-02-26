<?php

namespace App\Actions\WEB\Auth;

use App\DTO\Admin\User\UpdateUserDTO;
use App\Mail\ChangePasswordMail;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class NewPasswordAction
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function execute(Request $request): JsonResponse
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                Mail::to($user)->send(new ChangePasswordMail(
                        new UpdateUserDTO(
                            user: $user,
                            password: $password,
                        ),
                    ),
                );

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? response()->json(
                data: [
                    'message' => [
                        'status'  => __($status),
                        'message' => 'Ваш пароль изменен',
                        'link'    => route('main'),
                    ],
                ],
            )
            : response()->json(['email' => __($status)], 422);
    }

}
