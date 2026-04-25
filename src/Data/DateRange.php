<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Data;

final readonly class DateRange
{
    public function __construct(
        public string $start,
        public string $end,
    ) {}

    /**
     * @return array<string, string>
     */
    public function toArray(): array
    {
        return [
            'start' => $this->start,
            'end' => $this->end,
        ];
    }
}
