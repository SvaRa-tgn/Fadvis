<?php

namespace App\Interfaces;

use App\DTO\Profile\OrderItems\CreateOrderItemsDTO;
use App\Models\OrderItems;

interface IMakeProthesisService
{
    public function setRelations (CreateOrderItemsDTO $dto): bool;
}
