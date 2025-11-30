<?php

namespace App\DTO\Admin\Category;

use App\Enum\Status;
use App\Models\Category;

readonly class UpdateCategoryDTO
{
    public function __construct(
        public Category $category,
        public ?Status  $status = null,
        public ?string  $name = null,
        public ?string  $slug = null,
        public ?string  $second_name = null,
        public ?string  $description_index = null,
        public ?string  $description_page = null,
        public ?string  $img = null,
    ) {}
}
