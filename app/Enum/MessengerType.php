<?php

namespace App\Enum;

use App\Interfaces\EnumWithCaption;

enum MessengerType: string implements EnumWithCaption
{
    case TELEGRAM  = 'Telegram';
    case WHATS_APP = 'Whats_app';
    case MAX       = 'Max';

    public function caption(): string
    {
        return match ($this) {
            self::TELEGRAM  => 'Telegram',
            self::WHATS_APP => 'Whats_app',
            self::MAX       => 'Max',

        };
    }

    public static function getAllMessenger(): array
    {
        return [
            self::TELEGRAM->value,
            self::WHATS_APP->value,
            self::MAX->value,
        ];
    }
}
