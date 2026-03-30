<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Enums;

enum Capability: string
{
    case Payment = 'payment';
    case Refund = 'refund';
    case Settlement = 'settlement';
    case Reconciliation = 'reconciliation';
    case Disbursement = 'disbursement';
    case Webhook = 'webhook';
    case Provisioning = 'provisioning';

    public function label(): string
    {
        return match ($this) {
            self::Payment => 'Payment Processing',
            self::Refund => 'Refund Processing',
            self::Settlement => 'Settlement Reporting',
            self::Reconciliation => 'Reconciliation',
            self::Disbursement => 'Disbursement / Payout',
            self::Webhook => 'Webhook Handling',
            self::Provisioning => 'Merchant Provisioning',
        };
    }
}
