<?php

namespace App\Enum;

use App\Interfaces\EnumWithCaption;

enum Status: string implements EnumWithCaption
{
    case ACTIVE     = 'active';
    case DEACTIVATE = 'deactivate';

    public function caption(): string
    {
        return match ($this) {
            self::ACTIVE     => 'Активный',
            self::DEACTIVATE => 'Не активный',
        };
    }

    public static function values(): array
    {
        return [
            self::ACTIVE->value,
            self::DEACTIVATE->value,
        ];
    }

    public static function getAllStatus(): array
    {
        return [
            self::ACTIVE,
            self::DEACTIVATE,
        ];
    }
}
