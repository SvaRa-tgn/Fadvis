<?php

namespace App\Exceptions;

use Exception;

class CreateModelException extends Exception
{
    protected $message = 'Ошибка при создании записи';
}
