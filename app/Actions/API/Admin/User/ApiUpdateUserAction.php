<?php

namespace App\Actions\API\Admin\User;

use App\DTO\Admin\User\UpdateUserDTO;
use App\Enum\ErrorType;
use App\Enum\PopUpContent;
use App\Exceptions\CreateModelException;
use App\Http\Resources\UserResource;
use App\Interfaces\IFindRoute;
use App\Interfaces\IUserRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiUpdateUserAction
{
    public function __construct(
        private readonly IUserRepository $userRepository,
        private readonly IFindRoute $findRoute,
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

        } catch (Exception $e) {
            throw new CreateModelException(
                message: ErrorType::ERROR_INFO->caption(),
            );
        }

        return new JsonResponse(
            data: [
                'data'    => new UserResource($user),
                'message' => [
                    'message' => PopUpContent::UPDATE_SUCCESS->caption(),
                    'link'    => $this->findRoute->getRoute($dto),
                ],
            ],
            status: Response::HTTP_OK,
        );
    }
}
