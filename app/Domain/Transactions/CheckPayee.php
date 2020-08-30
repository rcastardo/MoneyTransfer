<?php

namespace MoneyTransfer\Domain\Transactions;

use Exception;
use MoneyTransfer\Domain\Customers\{
    Customer,
    CustomerRetrieveTransactionInterface
};

class CheckPayee
{
    private int $id;
    private Customer $customer;

    /**
     * CheckPayee constructor.
     * @param CustomerRetrieveTransactionInterface $retrieve
     * @param int $id
     */
    public function __construct(CustomerRetrieveTransactionInterface $retrieve, int $id)
    {
        $this->id = $id;
        $this->customer = $retrieve->customer($id);
    }

    public function get()
    {
        return $this->customer;
    }
}
