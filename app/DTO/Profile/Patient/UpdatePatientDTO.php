<?php

namespace App\DTO\Profile\Patient;

use App\Enum\UserRoles;
use App\Models\Patient;

readonly class UpdatePatientDTO
{
    public function __construct(
        public Patient $patient,
        public ?string $name = null,
        public ?string $surname = null,
        public ?string $email = null,
        public ?string $phone = null,
        public ?string $patronymic = null,
    ) {}
}
