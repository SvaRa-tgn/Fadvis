<?php

namespace App\Interfaces;

/** @property-read string $value */
interface EnumWithCaption
{
    public function caption(): string;
}
