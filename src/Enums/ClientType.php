<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Enums;

/**
 * Represents the type of backbone instance registered on the control plane.
 *
 * A "client" is a backbone deployment, NOT an individual end-user.
 * - SaasMerchant: Moffhub-hosted backbone serving multiple merchants
 * - SaasDeveloper: Moffhub-hosted backbone for developer API access
 * - SelfHosted: Institution running their own backbone
 */
enum ClientType: string
{
    case SaasMerchant = 'saas_merchant';
    case SaasDeveloper = 'saas_developer';
    case SelfHosted = 'self_hosted';

    public function label(): string
    {
        return match ($this) {
            self::SaasMerchant => 'SaaS (Merchant)',
            self::SaasDeveloper => 'SaaS (Developer)',
            self::SelfHosted => 'Self-Hosted',
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::SaasMerchant => 'Moffhub-hosted backbone serving merchants via dashboard',
            self::SaasDeveloper => 'Moffhub-hosted backbone serving developers via API',
            self::SelfHosted => 'Client-hosted backbone (county, school, hospital, enterprise)',
        };
    }

    public function isSelfHosted(): bool
    {
        return $this === self::SelfHosted;
    }

    public function isSaas(): bool
    {
        return in_array($this, [self::SaasMerchant, self::SaasDeveloper], true);
    }
}
