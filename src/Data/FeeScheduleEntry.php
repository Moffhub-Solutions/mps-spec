<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Data;

final readonly class FeeScheduleEntry
{
    public function __construct(
        public string $channel,
        public string $feeType,
        public float $feePercentage = 0,
        public int $feeFlat = 0,
        public ?int $feeCap = null,
    ) {}

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'channel' => $this->channel,
            'fee_type' => $this->feeType,
            'fee_percentage' => $this->feePercentage,
            'fee_flat' => $this->feeFlat,
            'fee_cap' => $this->feeCap,
        ];
    }
}
