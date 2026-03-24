<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Enums;

enum ConnectorStatus: string
{
    case Draft = 'draft';
    case Submitted = 'submitted';
    case Testing = 'testing';
    case Certified = 'certified';
    case Rejected = 'rejected';
    case Revoked = 'revoked';

    public function label(): string
    {
        return match ($this) {
            self::Draft => 'Draft',
            self::Submitted => 'Submitted',
            self::Testing => 'Testing',
            self::Certified => 'Certified',
            self::Rejected => 'Rejected',
            self::Revoked => 'Revoked',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Draft => '#94a3b8',
            self::Submitted => '#3b82f6',
            self::Testing => '#f59e0b',
            self::Certified => '#22c55e',
            self::Rejected => '#ef4444',
            self::Revoked => '#6b7280',
        };
    }

    public function isPublishable(): bool
    {
        return $this === self::Certified;
    }
}
