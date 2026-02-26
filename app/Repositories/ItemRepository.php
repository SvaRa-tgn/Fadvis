<?php

namespace App\Repositories;

use App\DTO\Admin\Product\CreateProductDTO;
use App\DTO\Profile\Item\CreateItemDTO;
use App\Interfaces\IItemRepository;
use App\Models\Item;
use App\Models\Product;

class ItemRepository implements IItemRepository
{
    /**
     * @param CreateItemDTO $dto
     * @return Item
     */
    public function create(CreateItemDTO $dto): Item
    {
        $item = new Item();
        $item->order_items_id = $dto->orderItems->id;
        $item->product_id = $dto->product->id;
        $item->side = $dto->side;

        $item->save();

        return $item;
    }
}
