<?php
declare(strict_types=1);
namespace Moffhub\MpsSpec\Data;

final readonly class PaymentConfirmation
{
    public function __construct(
        public string $intentId,
        public string $paymentRef,
        public MoneyAmount $amount,
        public string $paymentMethod,
        public ?string $providerRef = null,
        public ?string $payerIdentifier = null,
    ) {}

    public function toArray(): array
    {
        return [
            'intent_id' => $this->intentId,
            'payment_ref' => $this->paymentRef,
            'amount' => $this->amount->toArray(),
            'payment_method' => $this->paymentMethod,
            'provider_ref' => $this->providerRef,
            'payer_identifier' => $this->payerIdentifier,
        ];
    }
}
