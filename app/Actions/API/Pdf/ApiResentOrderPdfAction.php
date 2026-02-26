<?php

namespace App\Actions\API\Pdf;

use App\DTO\Pdf\ResentOrderPdfDTO;
use App\Enum\PopUpContent;
use App\Exceptions\CreateModelException;
use App\Http\Resources\OrderResource;
use App\Interfaces\IGenerateOrderPdfService;
use App\Mail\ResendOrderMail;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class ApiResentOrderPdfAction
{
    public function __construct(
        private readonly IGenerateOrderPdfService $generatePdfService,
    ) {}

    /**
     * @param ResentOrderPdfDTO $dto
     * @return JsonResponse
     * @throws CreateModelException
     */
    public function execute(ResentOrderPdfDTO $dto): JsonResponse
    {
        try {
            $pdfContent = $this->generatePdfService->generate($dto->order)->output();

            Mail::to($dto->email)->send(
                new ResendOrderMail($dto->order, $pdfContent)
            );
        } catch (Exception $e) {
            throw new CreateModelException($e->getMessage());
        }

        return new JsonResponse(
            data: [
                'data'    => new OrderResource($dto->order),
                'message' => [
                    'message' => PopUpContent::ORDER_RESENT->caption(),
                    'link'    => route('profile.order.list', $dto->order->user),
                ],
            ],
            status: Response::HTTP_OK,
        );
    }
}
