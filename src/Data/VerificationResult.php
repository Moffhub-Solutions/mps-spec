<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Data;

use Moffhub\MpsSpec\Enums\ChargeStatus;

/**
 * What a provider says about a charge, payment or receipt we asked it about.
 *
 * Some providers answer on the spot (`answered` true, status Completed or
 * Failed). Others only accept the question and answer later by callback
 * (`answered` false, status Pending): the caller must not read that as a
 * verdict either way.
 */
final readonly class VerificationResult
{
    public function __construct(
        public string $reference,
        public ChargeStatus $status,
        public bool $answered,
        public ?string $vendorRef = null,
        public ?MoneyAmount $amount = null,
        public ?string $message = null,
    ) {}

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'reference' => $this->reference,
            'status' => $this->status->value,
            'answered' => $this->answered,
            'vendor_ref' => $this->vendorRef,
            'amount' => $this->amount?->toArray(),
            'message' => $this->message,
        ];
    }
}
