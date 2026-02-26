<?php

namespace App\Actions\API\Pdf;

use App\Enum\UserRoles;
use App\Exceptions\BadRequestException;
use App\Exceptions\CreateModelException;
use App\Interfaces\IGenerateOrderPdfService;
use App\Models\Order;
use Exception;
use Illuminate\Http\Response;

class ApiDownloadOrderPdfAction
{
    public function __construct(
        private readonly IGenerateOrderPdfService $generateOrderPdfService,
    ) {}

    /**
     * @param Order $order
     * @return Response
     * @throws CreateModelException|BadRequestException
     */
    public function execute(Order $order): Response
    {
        if (auth()->user()?->role !== UserRoles::MASTER && auth()->user()->id !== $order->user_id) {
            throw new BadRequestException(
                message: 'Возникла ошибка',
            );
        }

        try {
            $pdf = $this->generateOrderPdfService->generate($order);
        } catch (Exception $e) {
            throw new CreateModelException($e->getMessage());
        }

        return $pdf->download('order-'.$order->number.'.pdf');
    }
}
