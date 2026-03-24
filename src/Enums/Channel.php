<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Enums;

enum Channel: string
{
    case StkPush = 'stk_push';
    case Card = 'card';
    case BankTransfer = 'bank_transfer';
    case Ussd = 'ussd';
    case MobileMoney = 'mobile_money';
    case Qr = 'qr';
    case DirectDebit = 'direct_debit';

    public function label(): string
    {
        return match ($this) {
            self::StkPush => 'STK Push',
            self::Card => 'Card Payment',
            self::BankTransfer => 'Bank Transfer',
            self::Ussd => 'USSD',
            self::MobileMoney => 'Mobile Money',
            self::Qr => 'QR Code',
            self::DirectDebit => 'Direct Debit',
        };
    }
}
