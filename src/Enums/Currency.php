<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Enums;

enum Currency: string
{
    case KES = 'KES';
    case NGN = 'NGN';
    case GHS = 'GHS';
    case ZAR = 'ZAR';
    case USD = 'USD';
    case UGX = 'UGX';
    case TZS = 'TZS';
    case RWF = 'RWF';
    case EUR = 'EUR';
    case GBP = 'GBP';

    public function label(): string
    {
        return match ($this) {
            self::KES => 'Kenyan Shilling',
            self::NGN => 'Nigerian Naira',
            self::GHS => 'Ghanaian Cedi',
            self::ZAR => 'South African Rand',
            self::USD => 'US Dollar',
            self::UGX => 'Ugandan Shilling',
            self::TZS => 'Tanzanian Shilling',
            self::RWF => 'Rwandan Franc',
            self::EUR => 'Euro',
            self::GBP => 'British Pound',
        };
    }

    public function smallestUnit(): string
    {
        return match ($this) {
            self::UGX, self::TZS, self::RWF => '1',
            default => '0.01',
        };
    }
}
