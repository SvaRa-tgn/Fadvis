<?php

namespace App\Enum;

use App\Interfaces\EnumWithCaption;

enum ProthesisType: string implements EnumWithCaption
{
    case PROTHESIS_HAND  = 'prothesis_hand';
    case PROTHESIS_WRIST = 'prothesis_wrist';

    public function caption(): string
    {
        return match ($this) {
            self::PROTHESIS_HAND  => 'протез руки',
            self::PROTHESIS_WRIST => 'протез кисти',
        };
    }

    public static function values(): array
    {
        return [
            self::PROTHESIS_HAND->value,
            self::PROTHESIS_WRIST->value,
        ];
    }

    public static function getAllTypes(): array
    {
        return [
            self::PROTHESIS_HAND,
            self::PROTHESIS_WRIST,
        ];
    }
}
