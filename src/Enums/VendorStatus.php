<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Enums;

enum VendorStatus: string
{
    case Pending = 'pending';
    case Active = 'active';
    case Suspended = 'suspended';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::Active => 'Active',
            self::Suspended => 'Suspended',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Pending => '#f59e0b',
            self::Active => '#22c55e',
            self::Suspended => '#ef4444',
        };
    }
}
