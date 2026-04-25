# Moffhub Payment Standard (MPS)

The contract layer for building payment and service connectors against the **Moffhub Payment Standard**. This package contains only interfaces, DTOs, enums, and exceptions — no runtime logic, no framework dependencies. Implement against this and you are MPS-compliant.

If you only want to **use** a connector, you don't need this package directly. If you are **building** a connector, start with [`moffhub/connector-sdk`](https://packagist.org/packages/moffhub/connector-sdk), which provides a base class you can extend.

## Installation

```bash
composer require moffhub/mps-spec
```

Requires PHP 8.3+.

## What's in the box

- **Contracts** (`Moffhub\MpsSpec\Contracts\`) — `ConnectorInterface`, `ServiceConnectorInterface`, plus capability mixins (`HasChargeCapability`, `HasRefundCapability`, `HasSettlementCapability`, `HasDisbursementCapability`, `HasWebhookCapability`, `HasProvisioningCapability`).
- **Data** (`Moffhub\MpsSpec\Data\`) — Immutable `final readonly` DTOs: `ChargeRequest`, `ChargeResponse`, `ConnectorManifest`, `MoneyAmount`, `SettlementReport`, etc.
- **Enums** (`Moffhub\MpsSpec\Enums\`) — Backed string enums: `Capability`, `Channel`, `ChargeStatus`, `Currency`, `ConnectorType`, `SettlementModel`, etc.
- **Exceptions** (`Moffhub\MpsSpec\Exceptions\`) — Domain exceptions like `ChargeFailedException`, `WebhookVerificationFailedException`.

## The two connector shapes

A connector is one of two things:

| Type | Purpose | Implements |
|------|---------|------------|
| **Payment Connector** | Moves money (charges, refunds, settlements, disbursements) | `ConnectorInterface` + capability mixins |
| **Service Connector** | Domain validation and lifecycle (e.g. utility bill lookup, ticketing) | `ServiceConnectorInterface` |

Every connector declares its capabilities, channels, currencies, and required config in a `ConnectorManifest` returned from `manifest()`. The platform reads the manifest to wire up the connector.

## Minimal example

Here's the contract surface for a connector that takes payments and processes refunds:

```php
use Moffhub\MpsSpec\Contracts\ConnectorInterface;
use Moffhub\MpsSpec\Contracts\HasChargeCapability;
use Moffhub\MpsSpec\Contracts\HasRefundCapability;
use Moffhub\MpsSpec\Data\ChargeRequest;
use Moffhub\MpsSpec\Data\ChargeResponse;
use Moffhub\MpsSpec\Data\ConnectorManifest;
use Moffhub\MpsSpec\Data\HealthStatus;
use Moffhub\MpsSpec\Data\RefundResponse;
use Moffhub\MpsSpec\Enums\Capability;
use Moffhub\MpsSpec\Enums\Channel;
use Moffhub\MpsSpec\Enums\SettlementModel;

final class AcmeConnector implements ConnectorInterface, HasChargeCapability, HasRefundCapability
{
    public function manifest(): ConnectorManifest
    {
        return new ConnectorManifest(
            connectorId: 'acme',
            displayName: 'Acme Payments',
            version: '1.0.0',
            specVersion: '0.1',
            vendorName: 'Acme Inc.',
            vendorWebsite: 'https://acme.example',
            vendorSupportEmail: 'support@acme.example',
            supportedChannels: [Channel::Card],
            supportedCurrencies: ['USD'],
            capabilities: [Capability::Payment, Capability::Refund],
            settlementModel: SettlementModel::T1,
            requiredConfig: [/* ConfigField entries */],
        );
    }

    public function initialize(array $config): void { /* ... */ }
    public function healthCheck(): HealthStatus { /* ... */ }
    public function destroy(): void { /* ... */ }

    public function createCharge(ChargeRequest $request): ChargeResponse { /* ... */ }
    public function queryCharge(string $chargeId): ChargeResponse { /* ... */ }
    public function refund(string $chargeId, ?int $amountMinor = null): RefundResponse { /* ... */ }
}
```

In practice, you should extend `Moffhub\ConnectorSdk\BaseConnector` instead of implementing `ConnectorInterface` directly — it handles config validation and lifecycle for you.

## Capabilities

A connector advertises capabilities by listing them in the manifest **and** implementing the matching mixin:

| Capability | Interface | Methods |
|---|---|---|
| `Payment` | `HasChargeCapability` | `createCharge`, `queryCharge` |
| `Refund` | `HasRefundCapability` | `refund` |
| `Settlement` | `HasSettlementCapability` | `fetchSettlements` |
| `Disbursement` | `HasDisbursementCapability` | `disburse` |
| `Webhook` | `HasWebhookCapability` | `handleWebhook` |
| `Provisioning` | `HasProvisioningCapability` | `provision` |

The platform discovers a connector's capabilities by `instanceof` checks against these interfaces, so the manifest and the implementation must agree.

## Spec versioning

The `specVersion` field on `ConnectorManifest` declares which version of MPS the connector targets. This package's tagged version *is* the spec version — pin it explicitly:

```json
"require": {
    "moffhub/mps-spec": "^0.1"
}
```

Breaking changes to interfaces or DTOs ship in a new major version.

## License

MIT. See `LICENSE`.
