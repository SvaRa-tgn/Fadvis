<?php

namespace App\Interfaces;

use App\DTO\Profile\OrderItems\CreateOrderItemsDTO;
use App\Models\OrderItems;

interface IOrderItemsRepository
{
    public function create(CreateOrderItemsDTO $dto): OrderItems;
}
