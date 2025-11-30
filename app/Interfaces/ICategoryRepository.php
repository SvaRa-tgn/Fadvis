<?php

namespace App\Interfaces;

use App\DTO\Admin\Category\CreateCategoryDTO;
use App\DTO\Admin\Category\UpdateCategoryDTO;
use App\Enum\Status;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface ICategoryRepository
{
    public function create(CreateCategoryDTO $dto, array $image): Category;
    public function update(UpdateCategoryDTO $dto, array $image = null): Category;
    public function findByStatus(Status $catalogStatus): ?Collection;
}
