<?php

namespace App\DTO\Profile\Order;

use App\Enum\ProthesisSide;
use App\Enum\ProthesisType;
use App\Models\Order;
use App\Models\Patient;
use App\Models\User;

readonly class UpdateOrderDTO
{
    public function __construct(
        public Order          $order,
        public Patient        $patient,
        public ProthesisSide  $side,
        public string         $number,
        public ?ProthesisType $left_type = null,
        public ?ProthesisType $right_type = null,
    ) {}
}
