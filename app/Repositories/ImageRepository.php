<?php

namespace App\Repositories;

use App\DTO\Admin\Category\CreateCategoryDTO;
use App\DTO\Admin\Category\UpdateCategoryDTO;
use App\Enum\Status;
use App\Interfaces\ICategoryRepository;
use App\Interfaces\IImageRepository;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Database\Eloquent\Collection;

class ImageRepository implements IImageRepository
{
    /**
     * @param array $img
     * @return Image
     */
    public function create(array $img): Image
    {
        $image = new Image();
        $image->link = $img['url'];
        $image->path = $img['path'];

        $image->save();

        return $image;
    }

    /**
     * @param Image $image
     * @param array|null $img
     * @return Image
     */
    public function update(Image $image, array $img = null): Image
    {
        $image->link = $img['url'];
        $image->path = $img['path'];

        $image->save();

        return $image;
    }

    public function delete(Image $image): void
    {
        $image->delete();
    }
}
