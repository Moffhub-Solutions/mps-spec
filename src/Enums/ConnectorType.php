<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Enums;

enum ConnectorType: string
{
    case Payment = 'payment';
    case Service = 'service';
    case Settlement = 'settlement';

    public function label(): string
    {
        return match ($this) {
            self::Payment => 'Payment Connector',
            self::Service => 'Service Connector',
            self::Settlement => 'Settlement Connector',
        };
    }
}
