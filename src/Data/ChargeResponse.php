<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Data;

use Moffhub\MpsSpec\Enums\ChargeStatus;

final readonly class ChargeResponse
{
    /**
     * @param  array<string, mixed>|null  $channelData
     */
    public function __construct(
        public string $vendorRef,
        public ChargeStatus $status,
        public ?array $channelData = null,
        public ?int $estimatedCompletionSeconds = null,
    ) {}

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'vendor_ref' => $this->vendorRef,
            'status' => $this->status->value,
            'channel_data' => $this->channelData,
            'estimated_completion_seconds' => $this->estimatedCompletionSeconds,
        ];
    }
}
