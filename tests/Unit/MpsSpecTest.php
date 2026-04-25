<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Tests\Unit;

use Moffhub\MpsSpec\Data\ConnectorManifest;
use Moffhub\MpsSpec\Data\FeeScheduleEntry;
use Moffhub\MpsSpec\Data\ProvisionRequest;
use Moffhub\MpsSpec\Data\ProvisionResponse;
use Moffhub\MpsSpec\Enums\Capability;
use Moffhub\MpsSpec\Enums\Channel;
use Moffhub\MpsSpec\Enums\ConnectorType;
use Moffhub\MpsSpec\Enums\SettlementModel;
use PHPUnit\Framework\TestCase;

final class MpsSpecTest extends TestCase
{
    public function test_connector_type_enum_has_all_cases(): void
    {
        $cases = ConnectorType::cases();

        $this->assertCount(3, $cases);
        $this->assertSame('payment', ConnectorType::Payment->value);
        $this->assertSame('service', ConnectorType::Service->value);
        $this->assertSame('settlement', ConnectorType::Settlement->value);
    }

    public function test_connector_type_enum_labels(): void
    {
        $this->assertSame('Payment Connector', ConnectorType::Payment->label());
        $this->assertSame('Service Connector', ConnectorType::Service->label());
        $this->assertSame('Settlement Connector', ConnectorType::Settlement->label());
    }

    public function test_capability_enum_has_all_cases_including_provisioning(): void
    {
        $cases = Capability::cases();

        $this->assertCount(7, $cases);
        $this->assertSame('provisioning', Capability::Provisioning->value);
        $this->assertSame('Merchant Provisioning', Capability::Provisioning->label());
    }

    public function test_capability_enum_has_existing_cases(): void
    {
        $this->assertSame('payment', Capability::Payment->value);
        $this->assertSame('refund', Capability::Refund->value);
        $this->assertSame('settlement', Capability::Settlement->value);
        $this->assertSame('reconciliation', Capability::Reconciliation->value);
        $this->assertSame('disbursement', Capability::Disbursement->value);
        $this->assertSame('webhook', Capability::Webhook->value);
    }

    public function test_connector_manifest_with_new_fields(): void
    {
        $feeEntry = new FeeScheduleEntry(
            channel: 'stk_push',
            feeType: 'percentage',
            feePercentage: 1.5,
        );

        $manifest = new ConnectorManifest(
            connectorId: 'mpesa-ke',
            displayName: 'M-Pesa Kenya',
            version: '1.0.0',
            specVersion: '1.0.0',
            vendorName: 'Safaricom',
            vendorWebsite: 'https://safaricom.co.ke',
            vendorSupportEmail: 'support@safaricom.co.ke',
            supportedChannels: [Channel::StkPush],
            supportedCurrencies: ['KES'],
            capabilities: [Capability::Payment, Capability::Provisioning],
            settlementModel: SettlementModel::VendorLed,
            requiredConfig: [],
            webhookEvents: ['payment.completed'],
            settlementDelayHours: 24,
            feeSchedule: [$feeEntry],
            supportsProvisioning: true,
        );

        $this->assertSame(24, $manifest->settlementDelayHours);
        $this->assertCount(1, $manifest->feeSchedule);
        $this->assertTrue($manifest->supportsProvisioning);
    }

    public function test_connector_manifest_to_array_includes_new_fields(): void
    {
        $feeEntry = new FeeScheduleEntry(
            channel: 'card',
            feeType: 'percentage_plus_flat',
            feePercentage: 2.5,
            feeFlat: 3000,
            feeCap: 50000,
        );

        $manifest = new ConnectorManifest(
            connectorId: 'paystack-ng',
            displayName: 'Paystack Nigeria',
            version: '1.0.0',
            specVersion: '1.0.0',
            vendorName: 'Paystack',
            vendorWebsite: 'https://paystack.com',
            vendorSupportEmail: 'support@paystack.com',
            supportedChannels: [Channel::Card],
            supportedCurrencies: ['NGN'],
            capabilities: [Capability::Payment],
            settlementModel: SettlementModel::VendorLed,
            requiredConfig: [],
            settlementDelayHours: 48,
            feeSchedule: [$feeEntry],
            supportsProvisioning: false,
        );

        $array = $manifest->toArray();

        $this->assertSame(48, $array['settlement_delay_hours']);
        $this->assertFalse($array['supports_provisioning']);
        $this->assertCount(1, $array['fee_schedule']);
        $this->assertSame('card', $array['fee_schedule'][0]['channel']);
        $this->assertSame('percentage_plus_flat', $array['fee_schedule'][0]['fee_type']);
    }

    public function test_connector_manifest_new_fields_default_values(): void
    {
        $manifest = new ConnectorManifest(
            connectorId: 'test',
            displayName: 'Test',
            version: '1.0.0',
            specVersion: '1.0.0',
            vendorName: 'Test',
            vendorWebsite: 'https://test.com',
            vendorSupportEmail: 'test@test.com',
            supportedChannels: [],
            supportedCurrencies: [],
            capabilities: [],
            settlementModel: SettlementModel::ClientLed,
            requiredConfig: [],
        );

        $this->assertNull($manifest->settlementDelayHours);
        $this->assertSame([], $manifest->feeSchedule);
        $this->assertFalse($manifest->supportsProvisioning);

        $array = $manifest->toArray();
        $this->assertNull($array['settlement_delay_hours']);
        $this->assertSame([], $array['fee_schedule']);
        $this->assertFalse($array['supports_provisioning']);
    }

    public function test_provision_request_construction(): void
    {
        $request = new ProvisionRequest(
            merchantId: 'merch-001',
            merchantName: 'Test Merchant',
            organizationId: 'org-001',
            merchantEmail: 'merchant@example.com',
            merchantPhone: '+254700000000',
            metadata: ['tier' => 'premium'],
        );

        $this->assertSame('merch-001', $request->merchantId);
        $this->assertSame('Test Merchant', $request->merchantName);
        $this->assertSame('org-001', $request->organizationId);
        $this->assertSame('merchant@example.com', $request->merchantEmail);
        $this->assertSame('+254700000000', $request->merchantPhone);
        $this->assertSame(['tier' => 'premium'], $request->metadata);
    }

    public function test_provision_request_optional_fields_default_to_null(): void
    {
        $request = new ProvisionRequest(
            merchantId: 'merch-002',
            merchantName: 'Minimal Merchant',
            organizationId: 'org-002',
        );

        $this->assertNull($request->merchantEmail);
        $this->assertNull($request->merchantPhone);
        $this->assertSame([], $request->metadata);
    }

    public function test_provision_response_construction_and_to_array(): void
    {
        $response = new ProvisionResponse(
            merchantRef: 'VENDOR-REF-123',
            identity: [
                'paybill' => '123456',
                'account_number' => 'MERCH-0042',
            ],
            displayInstructions: 'Pay to Paybill 123456, Account MERCH-0042',
        );

        $this->assertSame('VENDOR-REF-123', $response->merchantRef);
        $this->assertSame('123456', $response->identity['paybill']);
        $this->assertSame('Pay to Paybill 123456, Account MERCH-0042', $response->displayInstructions);

        $array = $response->toArray();

        $this->assertSame('VENDOR-REF-123', $array['merchant_ref']);
        $this->assertSame(['paybill' => '123456', 'account_number' => 'MERCH-0042'], $array['identity']);
        $this->assertSame('Pay to Paybill 123456, Account MERCH-0042', $array['display_instructions']);
    }

    public function test_provision_response_optional_display_instructions(): void
    {
        $response = new ProvisionResponse(
            merchantRef: 'REF-456',
            identity: ['id' => 'abc'],
        );

        $this->assertNull($response->displayInstructions);
        $this->assertNull($response->toArray()['display_instructions']);
    }

    public function test_fee_schedule_entry_construction_and_to_array(): void
    {
        $entry = new FeeScheduleEntry(
            channel: 'stk_push',
            feeType: 'percentage',
            feePercentage: 1.5,
            feeFlat: 0,
            feeCap: 200000,
        );

        $this->assertSame('stk_push', $entry->channel);
        $this->assertSame('percentage', $entry->feeType);
        $this->assertSame(1.5, $entry->feePercentage);
        $this->assertSame(0, $entry->feeFlat);
        $this->assertSame(200000, $entry->feeCap);

        $array = $entry->toArray();

        $this->assertSame('stk_push', $array['channel']);
        $this->assertSame('percentage', $array['fee_type']);
        $this->assertSame(1.5, $array['fee_percentage']);
        $this->assertSame(0, $array['fee_flat']);
        $this->assertSame(200000, $array['fee_cap']);
    }

    public function test_fee_schedule_entry_default_values(): void
    {
        $entry = new FeeScheduleEntry(
            channel: 'card',
            feeType: 'flat',
        );

        $this->assertSame(0.0, $entry->feePercentage);
        $this->assertSame(0, $entry->feeFlat);
        $this->assertNull($entry->feeCap);
    }

    public function test_fee_schedule_entry_percentage_plus_flat(): void
    {
        $entry = new FeeScheduleEntry(
            channel: 'bank_transfer',
            feeType: 'percentage_plus_flat',
            feePercentage: 1.0,
            feeFlat: 1500,
            feeCap: 50000,
        );

        $array = $entry->toArray();

        $this->assertSame('bank_transfer', $array['channel']);
        $this->assertSame('percentage_plus_flat', $array['fee_type']);
        $this->assertSame(1.0, $array['fee_percentage']);
        $this->assertSame(1500, $array['fee_flat']);
        $this->assertSame(50000, $array['fee_cap']);
    }
}
