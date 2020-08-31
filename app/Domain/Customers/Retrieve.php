<?php

namespace MoneyTransfer\Domain\Customers;

use Exception;
use MoneyTransfer\Infrastructure\Repository\CustomerCrudRepository;

class Retrieve implements CustomerRetrieveTransactionInterface
{
    /**
     * @throws Exception
     */
    public function customer(int $id): Customer
    {
        $customer = null;
        $repository = (new CustomerCrudRepository())->findById($id);

        switch ($repository['type']) {
            case Common::TYPE_CUSTOMER:
                $customer = new Common();
                break;
            case ShopKeeper::TYPE_CUSTOMER:
                $customer = new ShopKeeper();
                break;
        }

        $customer->initialize(
            (int)$repository['id'],
            $repository['name'],
            $repository['email'],
            (float)$repository['value'],
            $repository['document'],
            null
        );

        return $customer;
    }
}
