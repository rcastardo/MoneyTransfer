<?php

namespace MoneyTransfer\Domain\Transactions;

use Exception;

class CheckFunds
{
    /**
     * @throws Exception
     */
    public static function haveEnoughMoney(float $userValueAccount, float $transactionValue): bool
    {
        return ($transactionValue > $userValueAccount);
    }
}
