<?php

namespace App\Interfaces;

use App\DTO\Admin\Category\CreateCategoryDTO;
use App\DTO\Admin\Category\UpdateCategoryDTO;
use App\Enum\Status;
use App\Models\Category;
use App\Models\Image;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface IImageRepository
{
    public function create(array $img): Image;
    public function update(Image $image, array $img = null): Image;
    public function delete(Image $image): void;

}
