<?php

namespace App\Interfaces;

use App\DTO\Admin\User\CreateUserDTO;
use App\DTO\Admin\User\UpdateUserDTO;
use App\Enum\UserRoles;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

/**
 * @method User find(int $id)
 */
interface IUserRepository
{
    public function create(CreateUserDTO $dto): User;
    public function update(UpdateUserDTO $dto): User;
    public function findByRole(UserRoles $userRoles): ?User;
    public function findByRoleUser(): Collection;
}
