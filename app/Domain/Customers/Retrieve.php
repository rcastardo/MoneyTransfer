<?php

namespace MoneyTransfer\Domain\Customers;

use Exception;
use MoneyTransfer\Infrastructure\Repository\CustomerRepositoryInterface;

class Retrieve implements CustomerRetrieveTransactionInterface
{
    private CustomerRepositoryInterface $customer;

    public function __construct(CustomerRepositoryInterface $customer)
    {
        $this->customer = $customer;
    }
    /**
     * @throws Exception
     */
    public function customer( int $id): Customer
    {
        $repository = $this->customer->findById($id);

        $customerFactory = Factory::build($repository['type']);

        $customerFactory->initialize(
            (int)$repository['id'],
            $repository['name'],
            $repository['email'],
            (float)$repository['value'],
            $repository['document'],
            null
        );

        return $customerFactory;
    }
}
