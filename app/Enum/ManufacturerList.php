<?php

namespace App\Enum;

use App\Interfaces\EnumWithCaption;

enum ManufacturerList: string implements EnumWithCaption
{
    case FADVIS = 'Fadvis';

    public function caption(): string
    {
        return match ($this) {
            self::FADVIS => 'ИП Фадеев Виктор Сергеевич',
        };
    }

    public static function values(): array
    {
        return [
            self::FADVIS->value,
        ];
    }

    public static function getAllManufacturer(): array
    {
        return [
            self::FADVIS,
        ];
    }
}
