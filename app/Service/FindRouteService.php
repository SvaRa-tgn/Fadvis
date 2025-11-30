<?php

namespace App\Service;

use App\DTO\Admin\User\UpdateUserDTO;
use App\Enum\UserRoles;
use App\Interfaces\IFindRoute;
use App\Interfaces\IUserRepository;

class FindRouteService implements IFindRoute
{
    public function __construct(
        private readonly IUserRepository $userRepository,
    ) {}

    public function getRoute(UpdateUserDTO $dto): string
    {
        $user = $this->userRepository->findByRole(UserRoles::MASTER);

        if ($dto->route === route('api.v1.admin.update', $user->id)) {

            $route = route('admin.user.show',
                [
                    $user->role,
                    str_slug(
                        title: $user->surname . ' ' . $user->name . ' ' . $user->patronymic,
                        separator: '_'),
                ]
            );
        } else{
            $route = route('admin.user.list');
        }

        return $route;
    }
}
