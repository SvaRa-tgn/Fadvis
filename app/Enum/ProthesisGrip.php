<?php

namespace App\Enum;

use App\Interfaces\EnumWithCaption;

enum ProthesisGrip: string implements EnumWithCaption
{
    case EKSC = 'ekcs';
    case ALFA = 'alfa';

    public function caption(): string
    {
        return match ($this) {
            self::EKSC => 'ЭКСЦ',
            self::ALFA => 'Альфа',
        };
    }

    public static function values(): array
    {
        return [
            self::EKSC->value,
            self::ALFA->value,
        ];
    }

    public static function getAllGrip(): array
    {
        return [
            self::EKSC,
            self::ALFA,
        ];
    }
}
