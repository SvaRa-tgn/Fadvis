<?php

namespace App\Enum;

use App\Interfaces\EnumWithCaption;

enum GenderType: string implements EnumWithCaption
{
    case MALE   = 'male';
    case FEMALE = 'female';

    public function caption(): string
    {
        return match ($this) {
            self::MALE   => 'мужской',
            self::FEMALE => 'женский',
        };
    }

    public static function values(): array
    {
        return [
            self::MALE->value,
            self::FEMALE->value,
        ];
    }

    public static function getAllGender(): array
    {
        return [
            self::MALE,
            self::FEMALE,
        ];
    }
}
