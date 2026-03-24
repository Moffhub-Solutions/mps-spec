<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Enums;

enum CertificationStatus: string
{
    case Pending = 'pending';
    case Running = 'running';
    case Passed = 'passed';
    case Failed = 'failed';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::Running => 'Running',
            self::Passed => 'Passed',
            self::Failed => 'Failed',
        };
    }

    public function isTerminal(): bool
    {
        return in_array($this, [self::Passed, self::Failed], true);
    }
}
