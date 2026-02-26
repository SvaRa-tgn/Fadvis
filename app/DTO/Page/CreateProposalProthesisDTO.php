<?php

namespace App\DTO\Page;

use App\Enum\AgePeriod;
use App\Enum\ProthesisFunction;
use App\Enum\ProthesisLevel;

readonly class CreateProposalProthesisDTO
{
    public function __construct(
        public AgePeriod         $agePeriod,
        public ProthesisLevel    $level,
        public ProthesisFunction $function,
        public string            $name,
        public string            $surname,
        public string            $email,
        public string            $phone,
        public string            $city,
        public bool              $isProgram,
        public ?string           $patronymic = null,
        public ?string           $questions = null,
    ) {}
}
