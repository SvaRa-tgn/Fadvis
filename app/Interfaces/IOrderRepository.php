<?php

namespace App\Interfaces;

use App\DTO\Profile\Order\CreateOrderDTO;
use App\DTO\Profile\Order\UpdateOrderDTO;
use App\Models\Order;
use App\Models\User;

interface IOrderRepository
{
    public function create(CreateOrderDTO $dto, User $user): Order;

    public function update(UpdateOrderDTO $dto, User $user): Order;

    public function findByNumber(string $number): ?Order;
}
