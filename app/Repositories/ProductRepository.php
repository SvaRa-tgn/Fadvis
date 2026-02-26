<?php

namespace App\Repositories;

use App\DTO\Admin\Product\CreateProductDTO;
use App\DTO\Admin\Product\UpdateProductDTO;
use App\Enum\Status;
use App\Interfaces\IProductRepository;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements IProductRepository
{
    /**
     * @param CreateProductDTO $dto
     * @param array $image
     * @return Product
     */
    public function create(CreateProductDTO $dto, array $image): Product
    {
        $product = new Product();
        $product->name = $dto->name;
        $product->slug = $dto->slug;
        $product->article = $dto->article;
        $product->category_id = $dto->category->id;
        $product->type = $dto->type;
        $product->description = $dto->description;
        $product->size = $dto->size;
        $product->side = $dto->side;
        $product->level = $dto->level;
        $product->system = $dto->system;
        $product->grip = $dto->grip;
        $product->volume_size = $dto->volumeSize;
        $product->length_size = $dto->lengthSize;
        $product->price = $dto->price;
        $product->color_id = $dto->color->id;
        $product->is_select_color = $dto->isSelectColor;
        $product->made = $dto->made;
        $product->manufacturer = $dto->manufacturer;
        $product->link = $image['url'];
        $product->path = $image['path'];
        $product->status = Status::ACTIVE;

        $product->save();

        return $product;
    }

    /**
     * @param UpdateProductDTO $dto
     * @param array|null $image
     * @return Product
     */
    public function update(UpdateProductDTO $dto, array $image = null): Product
    {
        $product = $dto->product;
        $product->name = $dto->name ?: $product->name;
        $product->slug = $dto->slug ?: $product->slug;
        $product->article = $dto->article ?: $product->article;
        $product->category_id = $dto->category->id ?: $product->category_id;
        $product->type = $dto->type ?: $product->type;
        $product->description = $dto->description ?: $product->description;
        $product->size = $dto->size ?: $product->size;
        $product->side = $dto->side ?: $product->side;
        $product->level = $dto->level ?: $product->level;
        $product->system = $dto->system ?: $product->system;
        $product->grip = $dto->grip ?: $product->grip;
        $product->volume_size = $dto->volumeSize ?: $product->volume_size;
        $product->length_size = $dto->lengthSize ?: $product->length_size;
        $product->price = $dto->price ?: $product->price;
        $product->color_id = $dto->color->id ?: $product->color_id;
        $product->is_select_color = $dto->isSelectColor ?: $product->is_select_color;
        $product->made = $dto->made ?: $product->made;
        $product->manufacturer = $dto->manufacturer ?: $product->manufacturer;
        $product->link = !empty($image) ? $image['url'] : $product->link;
        $product->path = !empty($image) ? $image['path'] : $product->path;
        $product->status = $dto->status ?: $product->status;

        $product->save();

        return $product;
    }

    /**
     * @param Status $catalogStatus
     * @return Collection
     */
    public function findByStatus(Status $catalogStatus): Collection
    {
        return Category::where('status', $catalogStatus->value)->get();
    }

    public function findById(int $id): Product
    {
        return Product::findOrFail($id);
    }

    public function findByIds(array $ids): Collection
    {
        return Product::whereIn('id', $ids)->get();
    }

    /** @return Collection|null */
    public function getActive(): ?Collection
    {
        return Product::where('status', Status::ACTIVE)->get();
    }
}
