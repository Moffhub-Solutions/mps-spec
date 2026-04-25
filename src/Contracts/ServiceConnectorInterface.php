<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Contracts;

use Moffhub\MpsSpec\Data\HealthStatus;
use Moffhub\MpsSpec\Data\PaymentConfirmation;
use Moffhub\MpsSpec\Data\ServiceConnectorManifest;
use Moffhub\MpsSpec\Data\ServiceTransaction;
use Moffhub\MpsSpec\Data\ServiceTransactionResult;

interface ServiceConnectorInterface
{
    public function manifest(): ServiceConnectorManifest;

    /**
     * @param  array<string, mixed>  $config
     */
    public function initialize(array $config): void;

    public function registerTransaction(ServiceTransaction $transaction): ServiceTransactionResult;

    public function confirmPayment(string $transactionRef, PaymentConfirmation $confirmation): void;

    public function cancelTransaction(string $transactionRef): void;

    public function healthCheck(): HealthStatus;

    public function destroy(): void;
}
