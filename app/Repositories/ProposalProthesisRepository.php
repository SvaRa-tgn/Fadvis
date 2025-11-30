<?php

namespace App\Repositories;

use App\DTO\Page\CreateProposalProthesisDTO;
use App\Enum\ProposalStatus;
use App\Interfaces\IProposalProthesisRepository;
use App\Models\ProposalProthesis;

class ProposalProthesisRepository implements IProposalProthesisRepository
{
    public function create(CreateProposalProthesisDTO $dto): ProposalProthesis
    {
        $proposalProthesis = new ProposalProthesis();
        $proposalProthesis->surname = $dto->surname;
        $proposalProthesis->name = $dto->name;
        $proposalProthesis->patronymic = $dto->patronymic;
        $proposalProthesis->email = $dto->email;
        $proposalProthesis->phone = $dto->phone;
        $proposalProthesis->city = $dto->city;
        $proposalProthesis->age_period = $dto->agePeriod;
        $proposalProthesis->prothesis_type = $dto->type;
        $proposalProthesis->prothesis_function = $dto->function;
        $proposalProthesis->is_program = $dto->isProgram;
        $proposalProthesis->questions = $dto->questions;
        $proposalProthesis->status = ProposalStatus::NEW;

        $proposalProthesis->save();

        return $proposalProthesis;
    }
}
