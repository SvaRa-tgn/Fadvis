<?php

namespace App\Interfaces;

use App\DTO\Admin\Product\CreateProductDTO;
use App\DTO\Admin\Product\UpdateProductDTO;
use App\Enum\Status;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

interface IProductRepository
{
    public function create(CreateProductDTO $dto, array $image): Product;
    public function update(UpdateProductDTO $dto, array $image = null): Product;
    public function findById(int $id): Product;
    public function getActive(): ?Collection;
}
