<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Enums;

enum EntryType: string
{
    case Debit = 'debit';
    case Credit = 'credit';

    public function label(): string
    {
        return match ($this) {
            self::Debit => 'Debit',
            self::Credit => 'Credit',
        };
    }
}
