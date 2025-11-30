<?php

namespace App\Enum;

use App\Interfaces\EnumWithCaption;

enum ErrorType: string implements EnumWithCaption
{
    case ERROR          = 'error';
    case ERROR_INFO     = 'error_info';
    case NOT_FOUND_USER = 'not_found_user';

    public function caption(): string
    {
        return match ($this) {
            self::ERROR          => 'Ошибка',
            self::ERROR_INFO     => 'Во время обработки данных возникла ошибка, попробуйте позднее.
            Если проблема повторится свяжитесь с администрацией сайта',
            self::NOT_FOUND_USER => 'Пользователь не найден'
        };
    }
}
