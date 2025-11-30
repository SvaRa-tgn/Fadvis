<?php

namespace App\Actions\API\Page;

use App\DTO\Page\CreateProposalProthesisDTO;
use App\Enum\PopUpContent;
use App\Enum\UserRoles;
use App\Http\Resources\ProposalProthesisResource;
use App\Interfaces\IProposalProthesisRepository;
use App\Interfaces\IUserRepository;
use App\Mail\ProposalProthesesMail;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class SendProposalProthesisAction
{
    public function __construct(
        private readonly IProposalProthesisRepository $proposalProthesisRepository,
        private readonly IUserRepository $userRepository,
    ) {}

    public function execute(CreateProposalProthesisDTO $dto): JsonResponse
    {
        $proposalProthesis = $this->proposalProthesisRepository->create($dto);

        $user = $this->userRepository->findByRole(UserRoles::MASTER);

        Mail::to($user->email)->send(New ProposalProthesesMail($proposalProthesis, $user));

        return new JsonResponse(
            data: [
                'data'    => new ProposalProthesisResource($proposalProthesis),
                'message' => [
                    'message' => PopUpContent::PROPOSAL_PROTHESIS_CREATE->caption(),
                    'route'   => route('main'),
                ],
            ],
            status: Response::HTTP_ACCEPTED,
        );
    }
}
