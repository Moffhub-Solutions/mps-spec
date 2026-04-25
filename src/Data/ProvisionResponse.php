<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Data;

final readonly class ProvisionResponse
{
    /**
     * @param  array<string, mixed>  $identity  e.g. {"paybill": "123456", "account_number": "MERCH-0042", "display_instructions": "Pay to..."}
     */
    public function __construct(
        public string $merchantRef,
        public array $identity,
        public ?string $displayInstructions = null,
    ) {}

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'merchant_ref' => $this->merchantRef,
            'identity' => $this->identity,
            'display_instructions' => $this->displayInstructions,
        ];
    }
}
