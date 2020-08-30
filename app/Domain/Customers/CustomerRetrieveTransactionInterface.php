<?php

namespace MoneyTransfer\Domain\Customers;

interface CustomerRetrieveTransactionInterface
{
    public function customer(int $id): Customer;
}
