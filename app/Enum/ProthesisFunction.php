<?php

namespace App\Enum;

use App\Interfaces\EnumWithCaption;

enum ProthesisFunction: string implements EnumWithCaption
{
    case COSMETIC = 'cosmetic';
    case ACTIVE   = 'active';
    case MECHANIC = 'mechanic';

    public function caption(): string
    {
        return match ($this) {
            self::COSMETIC  => 'Косметический/рабочий',
            self::ACTIVE    => 'Активный тяговый',
            self::MECHANIC  => 'Электромеханический',
        };
    }

    public static function values(): array
    {
        return [
            self::COSMETIC->value,
            self::ACTIVE->value,
            self::MECHANIC->value,
        ];
    }

    public static function getAllTypes(): array
    {
        return [
            self::COSMETIC,
            self::ACTIVE,
            self::MECHANIC,
        ];
    }
}
