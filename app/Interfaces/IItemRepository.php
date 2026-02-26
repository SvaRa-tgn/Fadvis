<?php

namespace App\Interfaces;

use App\DTO\Profile\Item\CreateItemDTO;
use App\Models\Item;

interface IItemRepository
{
    public function create(CreateItemDTO $dto): Item;
}
