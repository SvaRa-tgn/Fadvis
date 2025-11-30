<?php

namespace App\Actions\API\Admin\User;

use App\DTO\Admin\User\UpdateUserDTO;
use App\Enum\ErrorType;
use App\Enum\PopUpContent;
use App\Http\Resources\UserResource;
use App\Interfaces\IFindRoute;
use App\Interfaces\IUserRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ApiUpdateUserAction
{
    public function __construct(
        private readonly IUserRepository $userRepository,
        private readonly IFindRoute $findRoute,
    ) {}

    /** @throws Exception */
    public function execute(UpdateUserDTO $dto): JsonResponse
    {
        try {
            $user = $this->userRepository->update($dto);

        } catch (Exception $e) {
            throw new Exception(
                message: ErrorType::ERROR_INFO->caption(),
            );
        }

        return new JsonResponse(
            data: [
                'data'    => new UserResource($user),
                'message' => [
                    'title'   => PopUpContent::UPDATE_SUCCESS->caption(),
                    'message' => PopUpContent::UPDATE_SUCCESS_INFO->caption(),
                    'route'   => $this->findRoute->getRoute($dto),
                ],
            ],
            status: Response::HTTP_OK,
        );
    }
}
