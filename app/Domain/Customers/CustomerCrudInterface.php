<?php

namespace MoneyTransfer\Domain\Customers;

interface CustomerCrudInterface
{
    public function save(Customer $user): void;
    public function updateValueAccount(int $id, float $value): void;
}
