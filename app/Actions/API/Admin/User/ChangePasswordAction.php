<?php

namespace App\Actions\API\Admin\User;

use App\DTO\Admin\User\UpdateUserDTO;
use App\Enum\ErrorType;
use App\Enum\PopUpContent;
use App\Exceptions\CreateModelException;
use App\Http\Resources\UserResource;
use App\Interfaces\IUserRepository;
use App\Mail\ChangePasswordMail;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class ChangePasswordAction
{
    public function __construct(
        private readonly IUserRepository $userRepository,
    ) {}

    /**
     * @param UpdateUserDTO $dto
     * @return JsonResponse
     * @throws CreateModelException
     */
    public function execute(UpdateUserDTO $dto): JsonResponse
    {
        try {
            $user = $this->userRepository->update($dto);

            Mail::to($user->email)->send(new ChangePasswordMail($dto));

            $user->tokens()->delete();
        } catch (Exception $e) {
            throw new CreateModelException(
                message: ErrorType::ERROR_INFO->caption(),
            );
        }

        return new JsonResponse(
            data: [
                'data'    => new UserResource($user),
                'message' => [
                    'message' => PopUpContent::PASSWORD_UPDATE_SUCCESS->caption(),
                    'link'    => route('main'),
                ],
            ],
            status: Response::HTTP_OK,
        );
    }
}
