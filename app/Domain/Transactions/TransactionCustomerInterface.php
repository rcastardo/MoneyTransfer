<?php

namespace MoneyTransfer\Domain\Transactions;

use MoneyTransfer\Domain\Customers\Customer;

interface TransactionCustomerInterface
{
    public function get(): Customer;
}
