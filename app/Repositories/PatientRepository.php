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
        $patient->birth_date = $dto->dateBirth;
        $patient->gender = $dto->gender;
        $patient->email = $dto->email;
        $patient->phone = $dto->phone;
        $patient->messenger = $dto->messenger;
        $patient->left_type = $dto->leftType ?? null;
        $patient->right_type = $dto->rightType ?? null;
        $patient->left_level = $dto->leftLevel ?? null;
        $patient->right_level = $dto->rightLevel ?? null;

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
        $patient->name = $dto->name ?? $patient->name;
        $patient->surname = $dto->surname ?? $patient->surname;
        $patient->patronymic = $dto->patronymic ?? $patient->patronymic;
        $patient->birth_date = $dto->dateBirth ?? $patient->birth_date;
        $patient->gender = $dto->gender ?? $patient->gender;
        $patient->email = $dto->email ?? $patient->email;
        $patient->phone = $dto->phone ?? $patient->phone;
        $patient->messenger = $dto->messenger ?? $patient->messenger;
        $patient->left_type = $dto->leftType;
        $patient->right_type = $dto->rightType;
        $patient->left_level = $dto->leftLevel;
        $patient->right_level = $dto->rightLevel;

        $patient->save();

        return $patient;
    }
}
