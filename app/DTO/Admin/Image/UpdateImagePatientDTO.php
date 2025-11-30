<?php

namespace App\DTO\Admin\Image;

use App\Models\Image;
use App\Models\Patient;
use App\Models\Product;

readonly class UpdateImagePatientDTO
{
    public function __construct(
        public Patient $patient,
        public Image $image,
        public string $image_patient,
    ) {}
}
