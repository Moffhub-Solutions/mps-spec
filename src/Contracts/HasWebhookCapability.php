<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Contracts;

use Moffhub\MpsSpec\Data\WebhookResult;

interface HasWebhookCapability
{
    /**
     * @param  array<string, string>  $headers
     */
    public function handleWebhook(array $headers, mixed $body): WebhookResult;
}
