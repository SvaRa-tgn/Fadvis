<?php

namespace App\DTO\Admin\Image;

use App\Models\Product;

readonly class AddImageDTO
{
    public function __construct(
        public Product $product,
        public array   $images,
    ) {}
}
