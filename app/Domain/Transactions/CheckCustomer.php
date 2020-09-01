<?php

namespace MoneyTransfer\Domain\Transactions;

use MoneyTransfer\Domain\Customers\{
    Customer,
    CustomerRetrieveTransactionInterface
};

class CheckCustomer implements TransactionCustomerInterface
{
    private CustomerRetrieveTransactionInterface $customer;
    private int $id;

    /**
     * CheckPayee constructor.
     * @param CustomerRetrieveTransactionInterface $retrieve
     * @param int $id
     */
    public function __construct(CustomerRetrieveTransactionInterface $retrieve, int $id)
    {
        $this->id = $id;
        $this->customer = $retrieve;
    }

    public function get(): Customer
    {
        return $this->customer->customer($this->id);
    }
}
