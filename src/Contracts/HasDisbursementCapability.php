<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Contracts;

use Moffhub\MpsSpec\Data\DisbursementRequest;
use Moffhub\MpsSpec\Data\DisbursementResponse;

interface HasDisbursementCapability
{
    public function disburse(DisbursementRequest $request): DisbursementResponse;
}
