<?php

namespace MoneyTransfer\Domain\Transactions;

use Exception;

class CheckFunds
{
    private float $userValueAccount;
    private float $transactionValue;

    public function __construct(float $userValueAccount, float $transactionValue)
    {
        $this->userValueAccount = $userValueAccount;
        $this->transactionValue = $transactionValue;
    }

    /**
     * @throws Exception
     */
    public function haveEnoughMoney(): void
    {
        if ($this->transactionValue > $this->userValueAccount) {
            throw new Exception('Não há dinheiro o suficiente na conta.');
        }
    }
}
