<?php

namespace App\Interfaces;

use App\DTO\Page\CreateProposalProthesisDTO;
use App\Models\ProposalProthesis;

interface IProposalProthesisRepository
{
    public function create(CreateProposalProthesisDTO $dto): ProposalProthesis;
}
