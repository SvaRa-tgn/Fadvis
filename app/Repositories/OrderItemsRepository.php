<?php

namespace App\Repositories;

use App\DTO\Profile\OrderItems\CreateOrderItemsDTO;
use App\Interfaces\IOrderItemsRepository;
use App\Models\OrderItems;

class OrderItemsRepository implements IOrderItemsRepository
{
    /**
     * @param CreateOrderItemsDTO $dto
     * @return OrderItems
     */
    public function create(CreateOrderItemsDTO $dto): OrderItems
    {
        $orderItems = new OrderItems();
        $orderItems->order_id = $dto->order->id;
        $orderItems->prothesis = $dto->orderItemsType->value;
        $orderItems->amount = $dto->amount;

        $orderItems->save();

        return $orderItems;
    }
}
