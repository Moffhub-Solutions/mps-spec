<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Data;

use Moffhub\MpsSpec\Enums\Capability;
use Moffhub\MpsSpec\Enums\Channel;
use Moffhub\MpsSpec\Enums\SettlementModel;

final readonly class ConnectorManifest
{
    /**
     * @param  array<Channel>  $supportedChannels
     * @param  array<string>  $supportedCurrencies
     * @param  array<Capability>  $capabilities
     * @param  array<ConfigField>  $requiredConfig
     * @param  array<string>  $webhookEvents
     */
    public function __construct(
        public string $connectorId,
        public string $displayName,
        public string $version,
        public string $specVersion,
        public string $vendorName,
        public string $vendorWebsite,
        public string $vendorSupportEmail,
        public array $supportedChannels,
        public array $supportedCurrencies,
        public array $capabilities,
        public SettlementModel $settlementModel,
        public array $requiredConfig,
        public array $webhookEvents = [],
    ) {}

    public function toArray(): array
    {
        return [
            'connector_id' => $this->connectorId,
            'display_name' => $this->displayName,
            'version' => $this->version,
            'spec_version' => $this->specVersion,
            'vendor' => [
                'name' => $this->vendorName,
                'website' => $this->vendorWebsite,
                'support_email' => $this->vendorSupportEmail,
            ],
            'supported_channels' => array_map(fn (Channel $c) => $c->value, $this->supportedChannels),
            'supported_currencies' => $this->supportedCurrencies,
            'capabilities' => array_map(fn (Capability $c) => $c->value, $this->capabilities),
            'settlement_model' => $this->settlementModel->value,
            'required_config' => array_map(fn (ConfigField $f) => $f->toArray(), $this->requiredConfig),
            'webhook_events' => $this->webhookEvents,
        ];
    }
}
