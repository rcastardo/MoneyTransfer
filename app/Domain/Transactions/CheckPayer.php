<?php

namespace MoneyTransfer\Domain\Transactions;

use Exception;
use MoneyTransfer\Domain\Customers\{
    Customer,
    CustomerRetrieveTransactionInterface
};

class CheckPayer
{
    private int $id;
    private Customer $customer;

    /**
     * CheckPayer constructor.
     * @param CustomerRetrieveTransactionInterface $retrieve
     * @param int $id
     */
    public function __construct(CustomerRetrieveTransactionInterface $retrieve, int $id)
    {
        $this->customer = $retrieve->customer($id);
        $this->id = $id;
    }

    public function canTransfer()
    {
        return $this->customer->allowsTransfer();
    }

    public function getUserValueAccount(): float
    {
        return $this->customer->getValue();
    }

    public function get(): Customer
    {
        return $this->customer;
    }
}
