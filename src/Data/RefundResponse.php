<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Data;

final readonly class RefundResponse
{
    public function __construct(
        public string $vendorRef,
        public string $status,
        public MoneyAmount $amount,
        public ?string $failureReason = null,
    ) {}

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'vendor_ref' => $this->vendorRef,
            'status' => $this->status,
            'amount' => $this->amount->toArray(),
            'failure_reason' => $this->failureReason,
        ];
    }
}
