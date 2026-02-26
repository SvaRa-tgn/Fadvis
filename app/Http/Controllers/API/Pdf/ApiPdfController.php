<?php

namespace App\Http\Controllers\API\Pdf;

use App\Actions\API\Pdf\ApiDownloadOrderPdfAction;
use App\Actions\API\Pdf\ApiResentOrderPdfAction;
use App\Exceptions\BadRequestException;
use App\Exceptions\CreateModelException;
use App\Http\Requests\Pdf\Order\ResendOrderPdfRequest;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ApiPdfController
{
    /**
     * @param Order $order
     * @param ApiDownloadOrderPdfAction $action
     * @return Response
     * @throws BadRequestException|CreateModelException
     */
    public function download(Order $order, ApiDownloadOrderPdfAction $action): Response
    {
        return $action->execute($order);
    }

    /**
     * @param ResendOrderPdfRequest $request
     * @param ApiResentOrderPdfAction $action
     * @return JsonResponse
     * @throws CreateModelException
     */
    public function resend(ResendOrderPdfRequest $request, ApiResentOrderPdfAction $action): JsonResponse
    {
        return $action->execute($request->getDto());
    }
}
