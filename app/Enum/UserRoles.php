<?php

namespace App\Enum;

use App\Interfaces\EnumWithCaption;
use Spatie\LaravelData\Attributes\Validation\Enum;

enum UserRoles: string implements EnumWithCaption
{
    case MASTER = 'master';
    case ADMIN  = 'admin';
    case USER   = 'user';

    public function caption(): string
    {
        return match ($this) {
            self::MASTER => 'владелец',
            self::ADMIN  => 'администратор',
            self::USER   => 'пользователь',
        };
    }

    public static function values(): array
    {
        return [
            self::MASTER->value,
            self::ADMIN->value,
            self::USER->value,
        ];
    }

    public static function getAllRoles(): array
    {
        return [
            self::MASTER,
            self::ADMIN,
            self::USER,
        ];
    }
}
