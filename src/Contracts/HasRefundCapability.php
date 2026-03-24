<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Contracts;

use Moffhub\MpsSpec\Data\MoneyAmount;
use Moffhub\MpsSpec\Data\RefundResponse;

interface HasRefundCapability
{
    public function refund(string $chargeId, MoneyAmount $amount): RefundResponse;
}
