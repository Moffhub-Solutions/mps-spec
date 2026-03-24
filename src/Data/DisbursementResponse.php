<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Data;

final readonly class DisbursementResponse
{
    public function __construct(
        public string $vendorRef,
        public string $status,
        public MoneyAmount $amount,
        public ?string $recipientIdentifier = null,
        public ?array $channelData = null,
        public ?string $failureReason = null,
    ) {}

    public function toArray(): array
    {
        return [
            'vendor_ref' => $this->vendorRef,
            'status' => $this->status,
            'amount' => $this->amount->toArray(),
            'recipient_identifier' => $this->recipientIdentifier,
            'channel_data' => $this->channelData,
            'failure_reason' => $this->failureReason,
        ];
    }
}
