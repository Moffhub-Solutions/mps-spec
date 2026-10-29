<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Contracts;

use Moffhub\MpsSpec\Data\VerificationResult;

/**
 * Ask the provider whether something we hold a reference for really happened.
 * It is a read: it never pays, refunds or changes anything, so it is safe to
 * repeat. The reference is whatever the provider can look up (a charge id, or
 * an M-Pesa receipt number).
 */
interface HasVerificationCapability
{
    public function verify(string $reference): VerificationResult;
}
