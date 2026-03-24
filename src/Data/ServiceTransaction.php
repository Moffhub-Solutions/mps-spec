<?php
declare(strict_types=1);
namespace Moffhub\MpsSpec\Data;

final readonly class ServiceTransaction
{
    public function __construct(
        public string $intentId,
        public string $serviceCode,
        public MoneyAmount $amount,
        public ?string $payerIdentifier = null,
        public ?string $payerName = null,
        public array $metadata = [],
    ) {}

    public function toArray(): array
    {
        return [
            'intent_id' => $this->intentId,
            'service_code' => $this->serviceCode,
            'amount' => $this->amount->toArray(),
            'payer_identifier' => $this->payerIdentifier,
            'payer_name' => $this->payerName,
            'metadata' => $this->metadata,
        ];
    }
}
