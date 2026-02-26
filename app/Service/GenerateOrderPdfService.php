<?php

namespace App\Service;

use App\Enum\OrderItemsType;
use App\Interfaces\IGenerateOrderPdfService;
use App\Models\Order;
use Barryvdh\DomPDF\PDF as PDF;
use Barryvdh\DomPDF\Facade\Pdf as PDFFacade;

class GenerateOrderPdfService implements IGenerateOrderPdfService
{
    /**
     * @param Order $order
     * @return PDF
     */
    public function generate(Order $order): PDF
    {
        $order->load(['user', 'patient', 'orderItems.items', 'orderItems.items.products']);

        $pdf = PDFFacade::loadView(
            view: 'pdf.order',
            data:[
                'order' => $order,
                'rightHand' => $order->orderItems->firstWhere(
                    key:'prothesis',
                    operator: OrderItemsType::LEFT_PROTHESIS_HAND,
                ),
                'leftHand' => $order->orderItems->firstWhere(
                    key: 'prothesis',
                    operator: OrderItemsType::RIGHT_PROTHESIS_HAND,
                ),
                'rightWrist' => $order->orderItems->firstWhere(
                    key: 'prothesis',
                    operator: OrderItemsType::LEFT_PROTHESIS_WRIST,
                ),
                'leftWrist' => $order->orderItems->firstWhere(
                    key: 'prothesis',
                    operator: OrderItemsType::RIGHT_PROTHESIS_WRIST,
                ),
            ],
        );

        $pdf->setPaper('A4');
        $pdf->setOptions([
            'defaultFont' => 'DejaVu Sans',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true
        ]);

        return $pdf;
    }
}
