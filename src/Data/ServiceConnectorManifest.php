<?php
declare(strict_types=1);
namespace Moffhub\MpsSpec\Data;

final readonly class ServiceConnectorManifest
{
    /**
     * @param  array<string>  $supportedServices  Service types this connector handles (parking, permits, school_fees, etc.)
     * @param  array<ConfigField>  $requiredConfig
     */
    public function __construct(
        public string $connectorId,
        public string $displayName,
        public string $version,
        public string $specVersion,
        public string $vendorName,
        public string $vendorWebsite,
        public string $vendorSupportEmail,
        public string $category,
        public string $description,
        public array $supportedServices,
        public array $supportedCurrencies,
        public array $requiredConfig,
        public ?string $commissionModel = null,
        public ?int $defaultCommissionAmount = null,
        public ?string $dashboardUrl = null,
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
            'category' => $this->category,
            'description' => $this->description,
            'supported_services' => $this->supportedServices,
            'supported_currencies' => $this->supportedCurrencies,
            'required_config' => array_map(fn (ConfigField $f) => $f->toArray(), $this->requiredConfig),
            'commission_model' => $this->commissionModel,
            'default_commission_amount' => $this->defaultCommissionAmount,
            'dashboard_url' => $this->dashboardUrl,
        ];
    }
}
