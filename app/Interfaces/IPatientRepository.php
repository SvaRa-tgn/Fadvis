<?php

namespace App\Interfaces;

use App\DTO\Profile\Patient\CreatePatientDTO;
use App\DTO\Profile\Patient\UpdatePatientDTO;
use App\Models\Patient;
use App\Models\User;

/**
 * @method User find($id)
 */
interface IPatientRepository
{
    public function create(CreatePatientDTO $dto, User $user): Patient;
    public function update(UpdatePatientDTO $dto): Patient;
}
