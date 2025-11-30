<?php

namespace App\Repositories;

use App\DTO\Admin\Category\UpdateCategoryDTO;
use App\Interfaces\IProductImageRepository;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductImage;

class ProductImageRepository implements IProductImageRepository
{
    /**
     * @param Product $product
     * @param Image $image
     * @return ProductImage
     */
    public function create(Product $product, Image $image): ProductImage
    {
        $productImage = new ProductImage();
        $productImage->product_id = $product->id;
        $productImage->image_id = $image->id;

        $productImage->save();

        return $productImage;
    }

    /**
     * @param UpdateCategoryDTO $dto
     * @return Category
     */
    public function update(UpdateCategoryDTO $dto, array $image = null): Category
    {
        $category = $dto->category;
        $category->name = $dto->name ?? $category->name;
        $category->second_name = $dto->second_name ?? $category->second_name;
        $category->description_index = $dto->description_index ?? $category->description_index;
        $category->description_page = $dto->description_page ?? $category->description_page;
        $category->link = $image['url'] ?? $category->link;
        $category->path = $image['path'] ?? $category->path;
        $category->status = $dto->status ?? $category->status;

        $category->save();

        return $category;
    }

    public function delete(ProductImage $productImage): void
    {
        $productImage->delete();
    }
}
