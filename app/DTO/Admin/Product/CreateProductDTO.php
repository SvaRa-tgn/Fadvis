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

readonly class CreateProductDTO
{
    public function __construct(
        public Category        $category,
        public Status          $status,
        public ProthesisType   $type,
        public ProthesisSize   $size,
        public ProthesisSide   $side,
        public ProthesisLevel  $level,
        public ProthesisSystem $system,
        public Color           $color,
        public string          $name,
        public string          $slug,
        public string          $article,
        public string          $description,
        public bool            $isSelectColor,
        public int             $price,
        public string          $made,
        public string          $manufacturer,
        public string          $img,
        public ?ProthesisGrip  $grip = null,
        public ?int            $volumeSize = null,
        public ?int            $lengthSize = null,
        public ?array          $images = null,
    ) {}
}
