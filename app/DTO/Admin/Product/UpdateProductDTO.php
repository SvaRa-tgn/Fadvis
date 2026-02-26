<?php

namespace App\DTO\Admin\Product;

use App\Enum\ProthesisGrip;
use App\Enum\ProthesisLevel;
use App\Enum\ProthesisSystem;
use App\Enum\Status;
use App\Enum\ProthesisSide;
use App\Enum\ProthesisSize;
use App\Enum\ProthesisType;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;

readonly class UpdateProductDTO
{
    public function __construct(
        public Product          $product,
        public ?Category        $category = null,
        public ?Status          $status = null,
        public ?ProthesisType   $type = null,
        public ?ProthesisSize   $size = null,
        public ?ProthesisSide   $side = null,
        public ?ProthesisLevel  $level = null,
        public ?ProthesisSystem $system = null,
        public ?ProthesisGrip   $grip = null,
        public ?Color           $color = null,
        public ?string          $name = null,
        public ?string          $slug = null,
        public ?string          $article = null,
        public ?string          $description = null,
        public ?bool            $isSelectColor = null,
        public ?int             $price = null,
        public ?string          $made = null,
        public ?string          $manufacturer = null,
        public ?string          $img = null,
        public ?string          $image = null,
        public ?int             $volumeSize = null,
        public ?int             $lengthSize = null,
    ) {}
}
