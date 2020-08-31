<?php

namespace MoneyTransfer\Domain\Transactions;

use Exception;
use MoneyTransfer\Domain\Customers\{
    Customer,
    CustomerRetrieveTransactionInterface
};

class CheckPayee
{
    private Customer $customer;

    /**
     * CheckPayee constructor.
     * @param CustomerRetrieveTransactionInterface $retrieve
     * @param int $id
     */
    public function __construct(CustomerRetrieveTransactionInterface $retrieve, int $id)
    {
        $this->customer = $retrieve->customer($id);
    }

    public function get(): Customer
    {
        return $this->customer;
    }
}
