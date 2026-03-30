<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Data;

final readonly class ProvisionRequest
{
    /**
     * @param  array<string, mixed>  $metadata
     */
    public function __construct(
        public string $merchantId,
        public string $merchantName,
        public string $organizationId,
        public ?string $merchantEmail = null,
        public ?string $merchantPhone = null,
        public array $metadata = [],
    ) {}
}
