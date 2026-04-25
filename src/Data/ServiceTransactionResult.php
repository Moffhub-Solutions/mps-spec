<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Data;

/**
 * Result from a service connector after registering a transaction.
 *
 * Three modes:
 * 1. approved=true, paymentHandled=false → "Valid charge, PayOrchestra should collect payment"
 * 2. approved=true, paymentHandled=true  → "Valid charge, vendor already collected payment (report-only mode)"
 * 3. approved=false                      → "Rejected, don't charge"
 */
final readonly class ServiceTransactionResult
{
    /**
     * @param  array<string, mixed>  $serviceData
     */
    public function __construct(
        public string $vendorRef,
        public string $status,
        public bool $approved = true,
        public bool $paymentHandled = false,
        public ?MoneyAmount $amount = null,
        public ?int $commissionAmount = null,
        public array $serviceData = [],
        public ?string $receiptInfo = null,
        public ?string $rejectionReason = null,
    ) {}

    public function isApproved(): bool
    {
        return $this->approved;
    }

    public function isPaymentHandledByVendor(): bool
    {
        return $this->paymentHandled;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'vendor_ref' => $this->vendorRef,
            'status' => $this->status,
            'approved' => $this->approved,
            'payment_handled' => $this->paymentHandled,
            'amount' => $this->amount?->toArray(),
            'commission_amount' => $this->commissionAmount,
            'service_data' => $this->serviceData,
            'receipt_info' => $this->receiptInfo,
            'rejection_reason' => $this->rejectionReason,
        ];
    }
}
