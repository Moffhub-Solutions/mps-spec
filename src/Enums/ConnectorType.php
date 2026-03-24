<?php
declare(strict_types=1);
namespace Moffhub\MpsSpec\Enums;

enum ConnectorType: string
{
    case Payment = 'payment';
    case Service = 'service';

    public function label(): string
    {
        return match ($this) {
            self::Payment => 'Payment Connector',
            self::Service => 'Service Connector',
        };
    }
}
