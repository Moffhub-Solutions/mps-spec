<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Exceptions;

use Moffhub\MpsSpec\Enums\PaymentIntentStatus;
use RuntimeException;

class InvalidTransitionException extends RuntimeException
{
    public function __construct(
        public readonly PaymentIntentStatus $from,
        public readonly PaymentIntentStatus $to,
    ) {
        parent::__construct("Cannot transition from [{$from->value}] to [{$to->value}].");
    }
}
