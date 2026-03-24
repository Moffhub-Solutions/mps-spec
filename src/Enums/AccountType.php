<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Enums;

enum AccountType: string
{
    case Asset = 'asset';
    case Liability = 'liability';
    case Revenue = 'revenue';
    case Expense = 'expense';

    public function label(): string
    {
        return match ($this) {
            self::Asset => 'Asset',
            self::Liability => 'Liability',
            self::Revenue => 'Revenue',
            self::Expense => 'Expense',
        };
    }
}
