<?php

namespace App\Enum;

use App\Interfaces\EnumWithCaption;

enum ProthesisLevel: string implements EnumWithCaption
{
    case SHOULDER_KNOT  = 'shoulder_knot';
    case ELBOW_KNOT     = 'elbow_knot';
    case WRIST_KNOT     = 'wrist_knot';
    case NOZZLE         = 'nozzle';
    case WRIST          = 'wrist';
    case FINGER         = 'finger';
    case UNIVERSAL_KNOT = 'universal_knot';

    public function caption(): string
    {
        return match ($this) {
            self::SHOULDER_KNOT  => 'Плечевой узел',
            self::ELBOW_KNOT     => 'Локтевой узел',
            self::WRIST_KNOT     => 'Запястный узел',
            self::NOZZLE         => 'Насадка',
            self::WRIST          => 'Пястье',
            self::FINGER         => 'Палец',
            self::UNIVERSAL_KNOT => 'Универсальный узел',
        };
    }

    public static function values(): array
    {
        return [
            self::SHOULDER_KNOT->value,
            self::ELBOW_KNOT->value,
            self::WRIST_KNOT->value,
            self::NOZZLE->value,
            self::WRIST->value,
            self::FINGER->value,
            self::UNIVERSAL_KNOT->value,
        ];
    }

    public static function getAllTypes(): array
    {
        return [
            self::SHOULDER_KNOT,
            self::ELBOW_KNOT,
            self::WRIST_KNOT,
            self::NOZZLE,
            self::WRIST,
            self::FINGER,
            self::UNIVERSAL_KNOT,
        ];
    }

    public static function getHandItem(): array
    {
        return [
            self::SHOULDER_KNOT,
            self::ELBOW_KNOT,
            self::WRIST_KNOT,
            self::NOZZLE,
            self::UNIVERSAL_KNOT,
        ];
    }

    public static function getWristItem(): array
    {
        return [
            self::WRIST,
            self::FINGER,
        ];
    }
}
