<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Data;

use Moffhub\MpsSpec\Enums\Channel;

final readonly class ChargeRequest
{
    /**
     * @param  array<string, string>  $metadata
     */
    public function __construct(
        public string $intentId,
        public MoneyAmount $amount,
        public string $payerIdentifier,
        public Channel $channel,
        public string $callbackUrl,
        public ?string $payerName = null,
        public array $metadata = [],
    ) {}

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'intent_id' => $this->intentId,
            'amount' => $this->amount->toArray(),
            'payer_identifier' => $this->payerIdentifier,
            'payer_name' => $this->payerName,
            'channel' => $this->channel->value,
            'callback_url' => $this->callbackUrl,
            'metadata' => $this->metadata,
        ];
    }
}
