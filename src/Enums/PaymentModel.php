<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Enums;

enum PaymentModel: string
{
    /**
     * Vendor has their OWN Paybill/payment processing.
     * Vendor collects money, settles to client.
     * Client just provides vendor API key.
     * Example: JamboPay with their own Paybill collecting for a county.
     */
    case VendorManaged = 'vendor_managed';

    /**
     * Vendor uses the CLIENT'S Paybill credentials on their platform.
     * Money goes directly to client's account.
     * Vendor's system initiates the M-Pesa/card charge using client's credentials.
     * Backbone needs callback access or vendor reports every transaction.
     * Example: JamboPay operating on county's Paybill 600XXX.
     * THIS is the most common model for county vendors today.
     */
    case VendorOnClientRails = 'vendor_on_client_rails';

    /**
     * Vendor handles domain logic only. No payment processing.
     * Client's backbone routes payments through a separate payment connector.
     * Backbone owns the Paybill callback URL.
     * Example: ParkLite (parking logic only, no payment integration).
     */
    case MerchantManaged = 'merchant_managed';

    /**
     * Vendor supports multiple modes. Client chooses on install.
     */
    case Either = 'either';

    public function label(): string
    {
        return match ($this) {
            self::VendorManaged => 'Vendor handles payments (vendor\'s Paybill)',
            self::VendorOnClientRails => 'Vendor handles payments (your Paybill)',
            self::MerchantManaged => 'You set up payments via backbone',
            self::Either => 'Your choice',
        };
    }

    public function merchantDescription(): string
    {
        return match ($this) {
            self::VendorManaged => 'Vendor collects payments through their own system and settles to your account. You just enter your vendor API key.',
            self::VendorOnClientRails => 'Vendor processes payments using YOUR Paybill credentials on their platform. Money goes directly to your account. You provide your Paybill credentials to the vendor.',
            self::MerchantManaged => 'Vendor handles the service only. You set up your own payment provider (M-Pesa, Paystack) on the backbone.',
            self::Either => 'This vendor supports multiple payment arrangements. Choose what works for you.',
        };
    }

    public function vendorCollectsPayment(): bool
    {
        return in_array($this, [self::VendorManaged, self::VendorOnClientRails], true);
    }

    public function clientOwnsPaybill(): bool
    {
        return in_array($this, [self::VendorOnClientRails, self::MerchantManaged], true);
    }

    public function backboneNeedsCallbackAccess(): bool
    {
        return in_array($this, [self::VendorOnClientRails, self::MerchantManaged], true);
    }

    public function requiresPaymentConnector(): bool
    {
        return $this === self::MerchantManaged;
    }

    public function vendorNeedsClientCredentials(): bool
    {
        return $this === self::VendorOnClientRails;
    }
}
