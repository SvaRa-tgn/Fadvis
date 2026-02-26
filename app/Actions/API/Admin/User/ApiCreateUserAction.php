<?php

namespace App\Actions\API\Admin\User;

use App\DTO\Admin\User\CreateUserDTO;
use App\Enum\ErrorType;
use App\Enum\PopUpContent;
use App\Exceptions\CreateModelException;
use App\Http\Resources\UserResource;
use App\Interfaces\IUserRepository;
use App\Mail\RegistrationMail;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ApiCreateUserAction
{
    public function __construct(
        private readonly IuserRepository $userRepository,
    ) {}

    /**
     * @param CreateUserDTO $dto
     * @return JsonResponse
     * @throws CreateModelException|Throwable
     */
    public function execute(CreateUserDTO $dto): JsonResponse
    {
        try {
            DB::beginTransaction();
            $user = $this->userRepository->create($dto);

            Mail::to($user->email)->send(new RegistrationMail($dto));
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new CreateModelException(
                message: ErrorType::ERROR_INFO->caption(),
            );
        }

        return new JsonResponse(
            data: [
                'data'    => new UserResource($user),
                'message' => [
                    'message' => PopUpContent::REG_SUCCESS->caption(),
                    'link'    => route('admin.user.list'),
                ],
            ],
            status: Response::HTTP_CREATED,
        );
    }
}
