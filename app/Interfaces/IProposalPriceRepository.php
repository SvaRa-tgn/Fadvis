<?php

namespace App\Interfaces;

use App\DTO\Page\CreateProposalPriceDTO;
use App\Models\ProposalPrice;

interface IProposalPriceRepository
{
    public function create(CreateProposalPriceDTO $dto): ProposalPrice;
}
