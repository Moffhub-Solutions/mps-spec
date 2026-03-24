<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Enums;

enum SettlementModel: string
{
    case ClientLed = 'client_led';
    case VendorLed = 'vendor_led';
    case Hybrid = 'hybrid';

    public function label(): string
    {
        return match ($this) {
            self::ClientLed => 'Client Led',
            self::VendorLed => 'Vendor Led',
            self::Hybrid => 'Hybrid',
        };
    }
}
