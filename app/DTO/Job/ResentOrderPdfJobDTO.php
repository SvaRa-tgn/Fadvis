<?php

namespace App\DTO\Job;

use App\Models\Order;

readonly class ResentOrderPdfJobDTO
{
    public function __construct(
        public Order $order,
        public string $email,
        public string $pdfContent,
    ) {}
}
