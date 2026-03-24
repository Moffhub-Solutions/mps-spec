<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Contracts;

use Moffhub\MpsSpec\Data\DateRange;
use Moffhub\MpsSpec\Data\SettlementReport;

interface HasSettlementCapability
{
    public function getSettlementReport(DateRange $range): SettlementReport;
}
