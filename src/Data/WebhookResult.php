<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Data;

use Moffhub\MpsSpec\Enums\ChargeStatus;

final readonly class WebhookResult
{
    public function __construct(
        public string $intentId,
        public string $vendorRef,
        public ChargeStatus $status,
        public MoneyAmount $amount,
        public ?string $failureReason = null,
        public mixed $rawPayload = null,
    ) {}

    public function toArray(): array
    {
        return [
            'intent_id' => $this->intentId,
            'vendor_ref' => $this->vendorRef,
            'status' => $this->status->value,
            'amount' => $this->amount->toArray(),
            'failure_reason' => $this->failureReason,
        ];
    }
}
