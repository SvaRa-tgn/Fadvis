<?php

namespace App\Enum;

use App\Interfaces\EnumWithCaption;

enum ProthesisSide: string implements EnumWithCaption
{
    case LEFT      = 'left';
    case RIGHT     = 'right';
    case UNIVERSAL = 'universal';

    public function caption(): string
    {
        return match ($this) {
            self::LEFT      => 'Левый',
            self::RIGHT     => 'Правый',
            self::UNIVERSAL => 'Универсальный',

        };
    }

    public function captionSide(): string
    {
        return match ($this) {
            self::LEFT      => 'Левая',
            self::RIGHT     => 'Правая',
            self::UNIVERSAL => 'Универсальная',

        };
    }

    public static function values(): array
    {
        return [
            self::LEFT->value,
            self::RIGHT->value,
            self::UNIVERSAL->value,
        ];
    }

    public static function getAllSides(): array
    {
        return [
            self::LEFT,
            self::RIGHT,
            self::UNIVERSAL,
        ];
    }
}
