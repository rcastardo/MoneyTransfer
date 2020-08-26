<?php

namespace MoneyTransfer\Domain\Users;

interface CustomerValidateInterface
{
    public function validate(Customer $customer): bool;
}