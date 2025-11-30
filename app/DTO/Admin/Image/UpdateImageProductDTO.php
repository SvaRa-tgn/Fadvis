<?php

namespace App\DTO\Admin\Image;

use App\Models\Image;
use App\Models\Product;

readonly class UpdateImageProductDTO
{
    public function __construct(
        public Product $product,
        public Image $image,
        public string $image_product,
    ) {}
}
