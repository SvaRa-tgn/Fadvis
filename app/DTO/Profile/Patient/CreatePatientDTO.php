<?php

namespace App\DTO\Profile\Patient;

use App\Enum\UserRoles;
use App\Models\User;

readonly class CreatePatientDTO
{
    public function __construct(
        public string  $name,
        public string  $surname,
        public string  $email,
        public string  $phone,
        public ?string $patronymic = null,
        public ?array  $img = null,
    ) {}
}
