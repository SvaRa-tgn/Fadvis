<?php

namespace App\Repositories;

use App\DTO\Page\CreateProposalPriceDTO;
use App\Enum\ProposalStatus;
use App\Interfaces\IProposalPriceRepository;
use App\Models\ProposalPrice;

class ProposalPriceRepository implements IProposalPriceRepository
{
    public function create(CreateProposalPriceDTO $dto): ProposalPrice
    {
        $proposalPrice = new ProposalPrice();
        $proposalPrice->name = $dto->name;
        $proposalPrice->surname = $dto->surname;
        $proposalPrice->patronymic = $dto->patronymic;
        $proposalPrice->email = $dto->email;
        $proposalPrice->phone = $dto->phone;
        $proposalPrice->organization = $dto->organization;
        $proposalPrice->city = $dto->city;
        $proposalPrice->interest = $dto->interest;
        $proposalPrice->questions = $dto->questions;
        $proposalPrice->status = ProposalStatus::NEW;

        $proposalPrice->save();

        return $proposalPrice;
    }
}
