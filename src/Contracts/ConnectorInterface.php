<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Contracts;

use Moffhub\MpsSpec\Data\ConnectorManifest;
use Moffhub\MpsSpec\Data\HealthStatus;

interface ConnectorInterface
{
    public function manifest(): ConnectorManifest;

    public function initialize(array $config): void;

    public function healthCheck(): HealthStatus;

    public function destroy(): void;
}
