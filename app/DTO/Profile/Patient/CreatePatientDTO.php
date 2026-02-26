<?php

namespace App\DTO\Profile\Patient;

use App\Enum\GenderType;
use App\Enum\MessengerType;
use App\Enum\ProthesisLevel;
use App\Enum\ProthesisType;
use App\Enum\UserRoles;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonImmutable;

readonly class CreatePatientDTO
{
    public function __construct(
        public CarbonImmutable  $dateBirth,
        public GenderType $gender,
        public MessengerType $messenger,
        public string  $name,
        public string  $surname,
        public string  $email,
        public string  $phone,
        public ?ProthesisType $leftType = null,
        public ?ProthesisType $rightType = null,
        public ?ProthesisLevel $leftLevel = null,
        public ?ProthesisLevel $rightLevel = null,
        public ?string $patronymic = null,
        public ?array  $img = null,
    ) {}
}
