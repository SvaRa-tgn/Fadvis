<?php

namespace App\Enum;

use App\Interfaces\EnumWithCaption;

enum CountryMade: string implements EnumWithCaption
{
    case RUSSIA = 'russia';

    public function caption(): string
    {
        return match ($this) {
            self::RUSSIA => 'Россия',
        };
    }

    public static function values(): array
    {
        return [
            self::RUSSIA->value,
        ];
    }

    public static function getAllCountry(): array
    {
        return [
            self::RUSSIA,
        ];
    }
}
