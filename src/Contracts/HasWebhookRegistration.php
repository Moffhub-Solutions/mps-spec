<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Contracts;

/**
 * For providers that only send callbacks to addresses registered with them
 * (for example a paybill's C2B confirmation and validation URLs), as opposed to
 * ones that take the callback address with each request. Registering is
 * repeatable: it sets the addresses to the ones given.
 */
interface HasWebhookRegistration
{
    /**
     * @return string the provider's own confirmation of the registration
     */
    public function registerWebhooks(string $confirmationUrl, string $validationUrl): string;
}
