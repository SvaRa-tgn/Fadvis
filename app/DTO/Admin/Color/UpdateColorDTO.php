<?php

namespace App\DTO\Admin\Color;

use App\Enum\Status;
use App\Models\Color;

readonly class UpdateColorDTO
{
    public function __construct(
        public Color   $color,
        public ?Status $status = null,
        public ?string $slug = null,
        public ?string $name = null,
        public ?string $article = null,
        public ?string $img = null,
    ) {}
}
