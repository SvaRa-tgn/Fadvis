<?php

namespace App\Enum;

use App\Interfaces\EnumWithCaption;

enum OrderStatus: string implements EnumWithCaption
{
    case FORMED     = 'processing';
    case NOT_FORMED = 'not_formed';

    public function caption(): string
    {
        return match ($this) {
            self::FORMED     => 'оформлен',
            self::NOT_FORMED => 'не оформлен',
        };
    }

    public static function values(): array
    {
        return [
            self::FORMED->value,
            self::NOT_FORMED->value,
        ];
    }

    public static function getAllTypes(): array
    {
        return [
            self::FORMED,
            self::NOT_FORMED,
        ];
    }
}
