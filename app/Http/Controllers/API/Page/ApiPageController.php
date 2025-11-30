<?php

namespace App\Http\Controllers\API\Page;


use App\Actions\API\Page\SendProposalPriceAction;
use App\Actions\API\Page\SendProposalProthesisAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Page\CreateProposalPriceRequest;
use App\Http\Requests\Page\CreateProposalProthesisRequest;
use Illuminate\Http\JsonResponse;

class ApiPageController extends Controller
{
    public function sendPrice(SendProposalPriceAction $action, CreateProposalPriceRequest $request): JsonResponse
    {
        return $action->execute($request->getDto());
    }

    public function sendProthesis(SendProposalProthesisAction $action, CreateProposalProthesisRequest $request): JsonResponse
    {
        return $action->execute($request->getDto());
    }
}
