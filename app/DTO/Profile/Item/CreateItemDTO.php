<?php

namespace App\DTO\Profile\Item;

use App\Enum\ProthesisSide;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Product;

readonly class CreateItemDTO
{
    public function __construct(
        public OrderItems $orderItems,
        public Product $product,
        public ProthesisSide $side,
    ) {}
}
