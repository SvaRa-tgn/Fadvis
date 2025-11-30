<?php

namespace App\Interfaces;

use App\DTO\Admin\Color\CreateColorDTO;
use App\DTO\Admin\Color\UpdateColorDTO;
use App\Enum\Status;
use App\Models\Color;
use Illuminate\Database\Eloquent\Collection;

interface IColorRepository
{
    public function create(CreateColorDTO $dto, array $image): Color;
    public function update(UpdateColorDTO $dto, array $image = null): Color;
    public function findByStatus(Status $catalogStatus): ?Collection;
}
