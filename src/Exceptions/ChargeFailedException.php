<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Exceptions;

class ChargeFailedException extends ConnectorException
{
    public function __construct(
        string $message,
        public readonly ?string $vendorRef = null,
        public readonly ?string $failureCode = null,
    ) {
        parent::__construct($message);
    }
}
