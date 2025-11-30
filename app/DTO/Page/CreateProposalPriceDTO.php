<?php

namespace App\DTO\Page;

readonly class CreateProposalPriceDTO
{
    public function __construct(
        public string  $name,
        public string  $surname,
        public string  $email,
        public string  $phone,
        public string  $organization,
        public string  $city,
        public ?string $patronymic = null,
        public ?string $interest = null,
        public ?string $questions = null,
    ) {}
}
