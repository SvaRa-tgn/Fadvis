<?php

namespace App\Repositories;

use App\DTO\Profile\Order\CreateOrderDTO;
use App\DTO\Profile\Order\UpdateOrderDTO;
use App\Interfaces\IOrderRepository;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class OrderRepository implements IOrderRepository
{
    public function create(CreateOrderDTO $dto): Order
    {
        $order = new Order();
        $order->number = $dto->number;
        $order->user_id = $dto->user->id;
        $order->patient_id = $dto->patient->id;
        $order->description = $dto->description ?? null;
        $order->amount = $dto->amount;

        $order->save();

        return $order;
    }

    public function findByNumber(string $number): ?Order
    {
        return Order::where("number", $number)->first();
    }

    public function getAllOrders(): Collection
    {
        return Order::all();
    }
}
