<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Contracts;

use Moffhub\MpsSpec\Data\ProvisionRequest;
use Moffhub\MpsSpec\Data\ProvisionResponse;

interface HasProvisioningCapability
{
    public function provision(ProvisionRequest $request): ProvisionResponse;

    public function deprovision(string $merchantRef): void;
}
