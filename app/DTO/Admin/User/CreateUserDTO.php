<?php

namespace App\DTO\Admin\User;

use App\Enum\UserRoles;

readonly class CreateUserDTO
{
    public function __construct(
        public UserRoles $role,
        public string    $name,
        public string    $surname,
        public string    $slug,
        public string    $email,
        public string    $phone,
        public string    $messenger,
        public string    $organization,
        public string    $address,
        public string    $password,
        public ?string   $patronymic = null,
        public ?string   $site = null,
        public ?string   $inn = null,
        public ?string   $ogrn = null,
    ) {}
}
