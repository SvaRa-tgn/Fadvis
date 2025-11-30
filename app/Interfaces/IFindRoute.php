<?php

namespace App\Interfaces;

use App\DTO\Admin\User\UpdateUserDTO;

interface IFindRoute
{
    public function getRoute(UpdateUserDTO $dto): string;
}
