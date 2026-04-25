<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Data;

final readonly class SettlementTransaction
{
    public function __construct(
        public string $vendorRef,
        public string $intentId,
        public MoneyAmount $amount,
        public MoneyAmount $fee,
        public string $settledAt,
    ) {}

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'vendor_ref' => $this->vendorRef,
            'intent_id' => $this->intentId,
            'amount' => $this->amount->toArray(),
            'fee' => $this->fee->toArray(),
            'settled_at' => $this->settledAt,
        ];
    }
}
