<?php

namespace App\Interfaces;

use App\DTO\Admin\Category\CreateCategoryDTO;
use App\DTO\Admin\Category\UpdateCategoryDTO;
use App\Enum\Status;
use App\Models\Category;
use App\Models\Image;
use App\Models\Patient;
use App\Models\PatientImage;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface IPatientImageRepository
{
    public function create(Patient $patient, Image $image): PatientImage;
    public function update(UpdateCategoryDTO $dto, array $image = null): Category;

}
