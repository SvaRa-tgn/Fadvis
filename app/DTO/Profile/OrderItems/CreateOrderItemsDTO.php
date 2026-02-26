<?php

namespace App\DTO\Profile\OrderItems;

use App\Enum\OrderItemsType;
use App\Enum\ProthesisSide;
use App\Models\Order;
use Illuminate\Support\Collection;

class CreateOrderItemsDTO
{
    public function __construct(
        public readonly Order   $order,
        public readonly Collection $products,
        public readonly ProthesisSide $side,
        public ?OrderItemsType $orderItemsType = null,
        public ?float $amount = null,
        public ?array $items = null,
    ) {}
}
