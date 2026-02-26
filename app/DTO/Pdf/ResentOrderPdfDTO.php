<?php

namespace App\DTO\Pdf;

use App\Models\Order;

readonly class ResentOrderPdfDTO
{
    public function __construct(
        public Order $order,
        public string $email,
    ) {}
}
