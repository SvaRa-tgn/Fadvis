<?php

namespace App\Enum;

use App\Interfaces\EnumWithCaption;

enum ProthesisSize: string
{
    case XXS    = 'XXS';
    case XS     = 'XS';
    case S      = 'S';
    case M      = 'M';
    case L      = 'L';
    case XL     = 'XL';
    case CUSTOM = 'Индивидуальный';

    public static function values(): array
    {
        return [
            self::XXS->value,
            self::XS->value,
            self::S->value,
            self::M->value,
            self::L->value,
            self::XL->value,
            self::CUSTOM->value,
        ];
    }

    public static function getAllSizes(): array
    {
        return [
            self::XXS,
            self::XS,
            self::S,
            self::M,
            self::L,
            self::XL,
            self::CUSTOM,
        ];
    }
}
