<?php

namespace App\Interfaces;

use App\DTO\Profile\Order\CreateOrderDTO;
use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

interface IOrderRepository
{
    public function create(CreateOrderDTO $dto): Order;
    public function findByNumber(string $number): ?Order;
    public function getAllOrders(): Collection;
}
