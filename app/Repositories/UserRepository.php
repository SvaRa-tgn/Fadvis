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
        $user->surname = $dto->surname ?? $dto->user->surname;
        $user->name = $dto->name ?? $dto->user->name;
        $user->patronymic = $dto->patronymic ?? $dto->user->patronymic;
        $user->role = $dto->role ?? $dto->user->role;
        $user->email = $dto->email ?? $dto->user->email;
        $user->phone = $dto->phone ?? $dto->user->phone;
        $user->site = $dto->site ?? $dto->user->site;
        $user->messenger = $dto->messenger ?? $dto->user->messenger;
        $user->organization = $dto->organization ?? $dto->user->organization;
        $user->address = $dto->address ?? $dto->user->address;
        $user->inn = $dto->inn ?? $dto->user->inn;
        $user->ogrn = $dto->ogrn ?? $dto->user->ogrn;
        $user->status = $dto->status ?? $dto->user->status;
        $user->password = Hash::make($dto->password) ?? $dto->user->password;

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
