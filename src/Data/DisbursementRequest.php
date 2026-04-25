<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Data;

final readonly class DisbursementRequest
{
    /**
     * @param  array<string, mixed>  $metadata
     */
    public function __construct(
        public string $referenceId,
        public MoneyAmount $amount,
        public string $recipientIdentifier,
        public ?string $recipientName = null,
        public ?string $reason = null,
        public array $metadata = [],
    ) {}

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'reference_id' => $this->referenceId,
            'amount' => $this->amount->toArray(),
            'recipient_identifier' => $this->recipientIdentifier,
            'recipient_name' => $this->recipientName,
            'reason' => $this->reason,
            'metadata' => $this->metadata,
        ];
    }
}
