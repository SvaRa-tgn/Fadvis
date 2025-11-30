<?php

namespace App\Repositories;

use App\DTO\Profile\Order\CreateOrderDTO;
use App\DTO\Profile\Order\UpdateOrderDTO;
use App\Interfaces\IOrderRepository;
use App\Models\Order;
use App\Models\User;

class OrderRepository implements IOrderRepository
{
    public function create(CreateOrderDTO $dto, User $user): Order
    {
        $order = new Order();
        $order->number = $dto->number;
        $order->user_id = $user->id;
        $order->patient_id = $dto->patient->id;
        $order->side = $dto->side;
        $order->left_type = $dto->left_type;
        $order->right_type = $dto->right_type;

        $order->save();

        return $order;
    }

    public function update(UpdateOrderDTO $dto, User $user): Order
    {
        $order = $dto->order;
        $order->patient_id = $dto->patient->id;
        $order->side = $dto->side;
        $order->left_type = $dto->left_type;
        $order->right_type = $dto->right_type;

        $order->save();

        return $order;
    }
    public function findByNumber(string $number): ?Order
    {
        return Order::where("number", $number)->first();
    }
}
