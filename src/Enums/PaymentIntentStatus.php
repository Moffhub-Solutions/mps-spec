<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Enums;

enum PaymentIntentStatus: string
{
    case Created = 'created';
    case Validated = 'validated';
    case Routed = 'routed';
    case Processing = 'processing';
    case Completed = 'completed';
    case Failed = 'failed';
    case Expired = 'expired';
    case Refunded = 'refunded';

    public function label(): string
    {
        return match ($this) {
            self::Created => 'Created',
            self::Validated => 'Validated',
            self::Routed => 'Routed',
            self::Processing => 'Processing',
            self::Completed => 'Completed',
            self::Failed => 'Failed',
            self::Expired => 'Expired',
            self::Refunded => 'Refunded',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Created => '#94a3b8',
            self::Validated => '#3b82f6',
            self::Routed => '#8b5cf6',
            self::Processing => '#f59e0b',
            self::Completed => '#22c55e',
            self::Failed => '#ef4444',
            self::Expired => '#6b7280',
            self::Refunded => '#06b6d4',
        };
    }

    public function isTerminal(): bool
    {
        return in_array($this, [self::Completed, self::Failed, self::Expired, self::Refunded], true);
    }

    /**
     * @return array<self>
     */
    public function allowedTransitions(): array
    {
        return match ($this) {
            self::Created => [self::Validated, self::Failed],
            self::Validated => [self::Routed, self::Failed],
            self::Routed => [self::Processing, self::Failed, self::Routed],
            self::Processing => [self::Completed, self::Failed, self::Routed, self::Expired],
            self::Completed => [self::Refunded],
            default => [],
        };
    }

    public function canTransitionTo(self $target): bool
    {
        return in_array($target, $this->allowedTransitions(), true);
    }
}
