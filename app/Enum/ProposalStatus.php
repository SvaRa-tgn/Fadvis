<?php

namespace App\Enum;

use App\Interfaces\EnumWithCaption;

enum ProposalStatus: string implements EnumWithCaption
{
    case NEW      = 'new';
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';

    public function caption(): string
    {
        return match ($this) {
            self::NEW       => 'новая',
            self::ACCEPTED  => 'одобрена',
            self::REJECTED  => 'отклонена',
        };
    }

    public static function values(): array
    {
        return [
            self::NEW->value,
            self::ACCEPTED->value,
            self::REJECTED->value,
        ];
    }
}
