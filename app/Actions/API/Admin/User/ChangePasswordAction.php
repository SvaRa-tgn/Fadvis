<?php

namespace App\Actions\API\Admin\User;

use App\DTO\Admin\User\UpdateUserDTO;
use App\Enum\ErrorType;
use App\Enum\PopUpContent;
use App\Enum\UserRoles;
use App\Http\Resources\UserResource;
use App\Interfaces\IUserRepository;
use App\Mail\ChangePasswordMail;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class ChangePasswordAction
{
    public function __construct(
        private readonly IUserRepository $userRepository,
    ) {}

    /** @throws Exception */
    public function execute(UpdateUserDTO $dto): JsonResponse
    {
        try {
            $user = $this->userRepository->update($dto);

            Mail::to($user->email)->send(New ChangePasswordMail($dto));

            $user->tokens()->delete();
        } catch (Exception $e) {
            throw new Exception(
                message: ErrorType::ERROR_INFO->caption(). $e->getMessage(),
            );
        }

        return new JsonResponse(
            data: [
                'data'    => new UserResource($user),
                'message' => [
                    'title'   => PopUpContent::PASSWORD_UPDATE_SUCCESS->caption(),
                    'message' => PopUpContent::PASSWORD_UPDATE_SUCCESS_INFO->caption(),
                    'route'   => route('logout'),
                ],
            ],
            status: Response::HTTP_OK,
        );
    }
}
