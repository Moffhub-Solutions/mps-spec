<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Enums;

enum ClientType: string
{
    case Merchant = 'merchant';
    case Developer = 'developer';
    case Institution = 'institution';

    public function label(): string
    {
        return match ($this) {
            self::Merchant => 'Merchant',
            self::Developer => 'Developer',
            self::Institution => 'Institution',
        };
    }
}
