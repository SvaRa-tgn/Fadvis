<?php

namespace App\DTO\Admin\Color;

readonly class CreateColorDTO
{
    public function __construct(
        public string $name,
        public string $slug,
        public string $article,
        public string $img,
    ) {}
}
