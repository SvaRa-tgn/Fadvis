<?php

namespace App\Interfaces;

use App\Models\Order;
use Barryvdh\DomPDF\PDF;

interface IGenerateOrderPdfService
{
    /**
     * @param Order $order
     * @return PDF
     */
    public function generate(Order $order): PDF;
}
