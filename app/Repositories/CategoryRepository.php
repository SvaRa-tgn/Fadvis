<?php

namespace App\Repositories;

use App\DTO\Admin\Category\CreateCategoryDTO;
use App\DTO\Admin\Category\UpdateCategoryDTO;
use App\Enum\Status;
use App\Interfaces\ICategoryRepository;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements ICategoryRepository
{
    /**
     * @param CreateCategoryDTO $dto
     * @param array $image
     * @return Category
     */
    public function create(CreateCategoryDTO $dto, array $image): Category
    {
        $category = new Category();
        $category->name = $dto->name;
        $category->slug = $dto->slug;
        $category->second_name = $dto->second_name;
        $category->description = $dto->description;
        $category->link = $image['url'];
        $category->path = $image['path'];
        $category->status = Status::ACTIVE;

        $category->save();

        return $category;
    }

    /**
     * @param UpdateCategoryDTO $dto
     * @param array|null $image
     * @return Category
     */
    public function update(UpdateCategoryDTO $dto, array $image = null): Category
    {
        $category = $dto->category;
        $category->name = $dto->name ?: $category->name;
        $category->slug = $dto->slug ?: $category->slug;
        $category->second_name = $dto->second_name ?: $category->second_name;
        $category->description = $dto->description ?: $category->description;
        $category->link = !empty($image) ? $image['url'] : $category->link;
        $category->path = !empty($image) ? $image['path'] : $category->path;
        $category->status = $dto->status ?: $category->status;

        $category->save();

        return $category;
    }

    /**
     * @param Status $catalogStatus
     * @return Collection
     */
    public function findByStatus(Status $catalogStatus): Collection
    {
        return Category::where('status', $catalogStatus->value)->get();
    }
}
