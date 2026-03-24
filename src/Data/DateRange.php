<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Data;

final readonly class DateRange
{
    public function __construct(
        public string $start,
        public string $end,
    ) {}

    public function toArray(): array
    {
        return [
            'start' => $this->start,
            'end' => $this->end,
        ];
    }
}
