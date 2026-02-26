<?php

namespace App\DTO\Admin\Category;

readonly class CreateCategoryDTO
{
    public function __construct(
        public string  $name,
        public string  $slug,
        public string  $second_name,
        public string  $description,
        public string  $img,
    ) {}
}
