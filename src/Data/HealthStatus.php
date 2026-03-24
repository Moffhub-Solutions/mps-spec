<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Data;

final readonly class HealthStatus
{
    public function __construct(
        public string $status,
        public ?string $message = null,
        public ?float $latencyMs = null,
    ) {}

    public function isHealthy(): bool
    {
        return $this->status === 'healthy';
    }

    public function toArray(): array
    {
        return [
            'status' => $this->status,
            'message' => $this->message,
            'latency_ms' => $this->latencyMs,
        ];
    }
}
