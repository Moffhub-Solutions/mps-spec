<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Tests\Unit;

use Moffhub\MpsSpec\Contracts\HasVerificationCapability;
use Moffhub\MpsSpec\Contracts\HasWebhookRegistration;
use Moffhub\MpsSpec\Data\MoneyAmount;
use Moffhub\MpsSpec\Data\VerificationResult;
use Moffhub\MpsSpec\Enums\ChargeStatus;
use PHPUnit\Framework\TestCase;

class VerificationResultTest extends TestCase
{
    public function testAnAnsweredVerdictCarriesTheMoneyTheProviderStated(): void
    {
        $result = new VerificationResult('RKTQDM7W6S', ChargeStatus::Completed, true, 'RKTQDM7W6S', new MoneyAmount(50000, 'KES'));

        $this->assertSame([
            'reference' => 'RKTQDM7W6S',
            'status' => 'completed',
            'answered' => true,
            'vendor_ref' => 'RKTQDM7W6S',
            'amount' => ['value' => 50000, 'currency' => 'KES'],
            'message' => null,
        ], $result->toArray());
    }

    public function testAQuestionTheProviderOnlyAcceptedIsNotAVerdict(): void
    {
        $result = new VerificationResult('RKTQDM7W6S', ChargeStatus::Pending, false, message: 'The answer will arrive by callback.');

        $this->assertFalse($result->answered);
        $this->assertFalse($result->status->isTerminal());
        $this->assertNull($result->toArray()['amount']);
    }

    public function testTheContractsAreInterfacesConnectorsMayImplement(): void
    {
        $this->assertTrue(interface_exists(HasVerificationCapability::class));
        $this->assertTrue(interface_exists(HasWebhookRegistration::class));
    }
}
