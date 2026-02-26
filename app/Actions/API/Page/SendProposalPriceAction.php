<?php

namespace App\Actions\API\Page;

use App\DTO\Page\CreateProposalPriceDTO;
use App\Enum\PopUpContent;
use App\Enum\UserRoles;
use App\Http\Resources\ProposalPriceResource;
use App\Interfaces\IProposalPriceRepository;
use App\Interfaces\IUserRepository;
use App\Mail\ProposalPriceMail;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class SendProposalPriceAction
{
    public function __construct(
        private readonly IProposalPriceRepository $proposalPriceRepository,
        private readonly IUserRepository $userRepository,
    ) {}

    /**
     * @param CreateProposalPriceDTO $dto
     * @return JsonResponse
     */
    public function execute(CreateProposalPriceDTO $dto): JsonResponse
    {
        $proposalPrice = $this->proposalPriceRepository->create($dto);

        $user = $this->userRepository->findByRole(UserRoles::MASTER);

        Mail::to($user->email)->send(New ProposalPriceMail($proposalPrice, $user));

        return new JsonResponse(
            data: [
                'data'    => new ProposalPriceResource($proposalPrice),
                'message' => [
                    'message' => PopUpContent::PROPOSAL_PRICE_CREATE->caption(),
                    'route'   => route('main'),
                ],
            ],
            status: Response::HTTP_ACCEPTED,
        );
    }
}
