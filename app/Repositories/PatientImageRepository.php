<?php

namespace App\Repositories;

use App\DTO\Admin\Category\UpdateCategoryDTO;
use App\Interfaces\IPatientImageRepository;
use App\Models\Category;
use App\Models\Image;
use App\Models\Patient;
use App\Models\PatientImage;

class PatientImageRepository implements IPatientImageRepository
{
    /**
     * @param Patient $patient
     * @param Image $image
     * @return PatientImage
     */
    public function create(Patient $patient, Image $image): PatientImage
    {
        $patientImage = new PatientImage();
        $patientImage->patient_id = $patient->id;
        $patientImage->image_id = $image->id;

        $patientImage->save();

        return $patientImage;
    }

    /**
     * @param UpdateCategoryDTO $dto
     * @return Category
     */
    public function update(UpdateCategoryDTO $dto, array $image = null): Category
    {
        $category = $dto->category;
        $category->name = $dto->name ?? $category->name;
        $category->second_name = $dto->second_name ?? $category->second_name;
        $category->description_index = $dto->description_index ?? $category->description_index;
        $category->description_page = $dto->description_page ?? $category->description_page;
        $category->link = $image['url'] ?? $category->link;
        $category->path = $image['path'] ?? $category->path;
        $category->status = $dto->status ?? $category->status;

        $category->save();

        return $category;
    }
}
