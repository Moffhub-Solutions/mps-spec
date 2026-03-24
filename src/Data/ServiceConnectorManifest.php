<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Data;

use Moffhub\MpsSpec\Enums\PaymentModel;

final readonly class ServiceConnectorManifest
{
    /**
     * @param  array<string>  $supportedServices
     * @param  array<ConfigField>  $requiredConfig
     * @param  PaymentModel  $paymentModel  How this vendor handles payments:
     *   - VendorManaged: Vendor collects payments (has own M-Pesa/Paystack). Merchant just provides vendor API key.
     *   - MerchantManaged: Vendor handles logic only. Merchant must set up their own payment connector (M-Pesa/Paystack).
     *   - Either: Vendor CAN collect, but merchant can CHOOSE to use their own payment rails instead.
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
        public PaymentModel $paymentModel = PaymentModel::VendorManaged,
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
            'payment_model' => $this->paymentModel->value,
            'commission_model' => $this->commissionModel,
            'default_commission_amount' => $this->defaultCommissionAmount,
            'dashboard_url' => $this->dashboardUrl,
        ];
    }
}
