<?php

namespace App\Enum;

use App\Interfaces\EnumWithCaption;

enum AgePeriod: string implements EnumWithCaption
{
    case EXTRA_SMALL = 'extra_small';
    case SMALL       = 'small';
    case MEDIUM      = 'medium';
    case LARGE       = 'large';

    public function caption(): string
    {
        return match ($this) {
            self::EXTRA_SMALL => 'от 5 до 13 лет',
            self::SMALL       => 'от 13 до 18 лет',
            self::MEDIUM      => 'от 18 до 35 лет',
            self::LARGE       => 'от 35 лет',
        };
    }

    public static function values(): array
    {
        return [
            self::EXTRA_SMALL->value,
            self::SMALL->value,
            self::MEDIUM->value,
            self::LARGE->value,
        ];
    }

    public static function getAllPeriod(): array
    {
        return [
            self::EXTRA_SMALL,
            self::SMALL,
            self::MEDIUM,
            self::LARGE,
        ];
    }
}
