<?php

namespace MoneyTransfer\Domain\Customers;

interface  CustomerValidateInterface
{
    public function validate(Customer $customer): bool;
}
