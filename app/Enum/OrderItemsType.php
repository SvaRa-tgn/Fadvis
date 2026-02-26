<?php

namespace App\Enum;

use App\Interfaces\EnumWithCaption;

enum OrderItemsType: string implements EnumWithCaption
{
    case LEFT_PROTHESIS_HAND   = 'left_prothesis_hand';
    case RIGHT_PROTHESIS_HAND  = 'right_prothesis_hand';
    case LEFT_PROTHESIS_WRIST  = 'left_prothesis_wrist';
    case RIGHT_PROTHESIS_WRIST = 'right_prothesis_wrist';

    public function caption(): string
    {
        return match ($this) {
            self::LEFT_PROTHESIS_HAND   => 'Протез левой руки',
            self::RIGHT_PROTHESIS_HAND  => 'Протез правой руки',
            self::LEFT_PROTHESIS_WRIST  => 'Протез левой кисти',
            self::RIGHT_PROTHESIS_WRIST => 'Протез правой кисти',
        };
    }

    public static function values(): array
    {
        return [
            self::LEFT_PROTHESIS_HAND->value,
            self::RIGHT_PROTHESIS_HAND->value,
            self::LEFT_PROTHESIS_WRIST->value,
            self::RIGHT_PROTHESIS_WRIST->value,
        ];
    }
}
