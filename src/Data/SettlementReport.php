<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Data;

final readonly class SettlementReport
{
    /**
     * @param  array<SettlementTransaction>  $transactions
     */
    public function __construct(
        public DateRange $period,
        public int $totalTransactions,
        public MoneyAmount $totalAmount,
        public MoneyAmount $totalFees,
        public MoneyAmount $netAmount,
        public array $transactions,
    ) {}

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'period' => $this->period->toArray(),
            'total_transactions' => $this->totalTransactions,
            'total_amount' => $this->totalAmount->toArray(),
            'total_fees' => $this->totalFees->toArray(),
            'net_amount' => $this->netAmount->toArray(),
            'transactions' => array_map(fn(SettlementTransaction $t) => $t->toArray(), $this->transactions),
        ];
    }
}
