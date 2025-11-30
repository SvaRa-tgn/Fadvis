<?php

namespace App\Repositories;

use App\DTO\Profile\Patient\CreatePatientDTO;
use App\DTO\Profile\Patient\UpdatePatientDTO;
use App\Interfaces\IPatientRepository;
use App\Models\Patient;
use App\Models\User;

class PatientRepository implements IPatientRepository
{
    /**
     * @param CreatePatientDTO $dto
     * @param User $user
     * @return Patient
     */
    public function create(CreatePatientDTO $dto, User $user): Patient
    {
        $patient = new Patient();
        $patient->user_id = $user->id;
        $patient->name = $dto->name;
        $patient->surname = $dto->surname;
        $patient->patronymic = $dto->patronymic;
        $patient->email = $dto->email;
        $patient->phone = $dto->phone;

        $patient->save();

        return $patient;
    }

    /**
     * @param UpdatePatientDTO $dto
     * @return Patient
     */
    public function update(UpdatePatientDTO $dto): Patient
    {
        $patient = $dto->patient;
        $patient->name = $dto->name;
        $patient->surname = $dto->surname;
        $patient->patronymic = $dto->patronymic;
        $patient->email = $dto->email;
        $patient->phone = $dto->phone;

        $patient->save();

        return $patient;
    }
}
