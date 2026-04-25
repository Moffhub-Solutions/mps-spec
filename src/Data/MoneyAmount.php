<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Data;

final readonly class MoneyAmount
{
    public function __construct(
        public int $value,
        public string $currency,
    ) {}

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'value' => $this->value,
            'currency' => $this->currency,
        ];
    }
}
