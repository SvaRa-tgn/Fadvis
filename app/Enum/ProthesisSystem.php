<?php

namespace App\Enum;

use App\Interfaces\EnumWithCaption;

enum ProthesisSystem: string implements EnumWithCaption
{
    case ACTIVE  = 'active';
    case PASSIVE = 'passive';

    public function caption(): string
    {
        return match ($this) {
            self::PASSIVE => 'Пассивный',
            self::ACTIVE  => 'Активный',
        };
    }

    public static function values(): array
    {
        return [
            self::PASSIVE->value,
            self::ACTIVE->value,
        ];
    }

    public static function getAllSystems(): array
    {
        return [
            self::PASSIVE,
            self::ACTIVE,
        ];
    }
}
