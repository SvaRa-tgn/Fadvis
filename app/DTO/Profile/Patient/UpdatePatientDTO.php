<?php

namespace App\DTO\Profile\Patient;

use App\Enum\GenderType;
use App\Enum\MessengerType;
use App\Enum\ProthesisLevel;
use App\Enum\ProthesisType;
use App\Enum\UserRoles;
use App\Models\Patient;
use Carbon\CarbonImmutable;

readonly class UpdatePatientDTO
{
    public function __construct(
        public Patient $patient,
        public ?MessengerType $messenger = null,
        public ?ProthesisType $leftType = null,
        public ?ProthesisType $rightType = null,
        public ?ProthesisLevel $leftLevel = null,
        public ?ProthesisLevel $rightLevel = null,
        public ?CarbonImmutable  $dateBirth = null,
        public ?GenderType $gender = null,
        public ?string  $name = null,
        public ?string  $surname = null,
        public ?string $patronymic = null,
        public ?string  $email = null,
        public ?string  $phone = null,
        public ?array  $img = null,
    ) {}
}
