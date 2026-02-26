<?php

namespace App\DTO\Profile\Order;

use App\Models\Patient;
use App\Models\User;

class CreateOrderDTO
{
    public function __construct(
        public readonly User    $user,
        public readonly Patient $patient,
        public readonly string  $number,
        public ?array           $leftProducts = null,
        public ?array           $rightProducts = null,
        public readonly ?string $description = null,
        public ?float           $amount = null,
    ) {}
}
