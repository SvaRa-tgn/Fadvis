<?php

namespace App\DTO\Admin\User;

use App\Enum\Status;
use App\Enum\UserRoles;
use App\Models\User;

readonly class UpdateUserDTO
{
    public function __construct(
        public User       $user,
        public ?UserRoles $role = null,
        public ?Status    $status = null,
        public ?string    $route =null,
        public ?string    $name = null,
        public ?string    $surname = null,
        public ?string    $patronymic = null,
        public ?string    $slug = null,
        public ?string    $email = null,
        public ?string    $phone = null,
        public ?string    $messenger = null,
        public ?string    $organization = null,
        public ?string    $address = null,
        public ?string    $site = null,
        public ?string        $inn = null,
        public ?string        $ogrn = null,
        public ?string        $password = null,
    ) {}
}
