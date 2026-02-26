<?php

namespace App\Repositories;

use App\DTO\Admin\User\CreateUserDTO;
use App\DTO\Admin\User\UpdateUserDTO;
use App\Enum\Status;
use App\Enum\UserRoles;
use App\Interfaces\IUserRepository;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class UserRepository implements IUserRepository
{
    /**
     * @param CreateUserDTO $dto
     * @return User
     * @method User find(int $id)
     */
    public function create(CreateUserDTO $dto): User
    {
        $user = new User();
        $user->name = $dto->name;
        $user->surname = $dto->surname;
        $user->patronymic = $dto->patronymic;
        $user->slug = $dto->slug;
        $user->role = $dto->role;
        $user->email = $dto->email;
        $user->phone = $dto->phone;
        $user->site = $dto->site;
        $user->messenger = $dto->messenger;
        $user->organization = $dto->organization;
        $user->address = $dto->address;
        $user->inn = $dto->inn;
        $user->ogrn = $dto->ogrn;
        $user->status = Status::ACTIVE;
        $user->password = Hash::make($dto->password);

        $user->save();

        return $user;
    }

    /**
     * @param UpdateUserDTO $dto
     * @return User
     */
    public function update(UpdateUserDTO $dto): User
    {
        $user = $dto->user;
        $user->surname = $dto->surname ?? $user->surname;
        $user->name = $dto->name ?? $user->name;
        $user->patronymic = $dto->patronymic ?? $user->patronymic;
        $user->role = $dto->role ?? $user->role;
        $user->email = $dto->email ?? $user->email;
        $user->phone = $dto->phone ?? $user->phone;
        $user->site = $dto->site ?? $user->site;
        $user->messenger = $dto->messenger ?? $user->messenger;
        $user->organization = $dto->organization ?? $user->organization;
        $user->address = $dto->address ?? $user->address;
        $user->inn = $dto->inn ?? $user->inn;
        $user->ogrn = $dto->ogrn ?? $user->ogrn;
        $user->status = $dto->status ?? $user->status;
        $user->password = !empty($dto->password) ? Hash::make($dto->password) : $user->password;

        $user->save();

        return $user;
    }

    public function findByRole(UserRoles $userRoles): ?User
    {
        return User::where('role', $userRoles->value)->first();
    }

    public function findByRoleUser(): Collection
    {
        return User::where('role', UserRoles::USER->value)->get();
    }
}
