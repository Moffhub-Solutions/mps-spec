<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Contracts;

use Moffhub\MpsSpec\Data\ChargeRequest;
use Moffhub\MpsSpec\Data\ChargeResponse;

interface HasChargeCapability
{
    public function createCharge(ChargeRequest $request): ChargeResponse;

    public function queryCharge(string $chargeId): ChargeResponse;
}
