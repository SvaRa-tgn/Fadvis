<?php

namespace App\DTO\Page;

use App\Enum\AgePeriod;
use App\Enum\ProthesisFunction;
use App\Enum\ProthesisType;

readonly class CreateProposalProthesisDTO
{
    public function __construct(
        public AgePeriod         $agePeriod,
        public ProthesisType     $type,
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
