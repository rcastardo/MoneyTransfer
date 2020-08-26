<?php

namespace MoneyTransfer\Domain\Users;

interface CustomerInterface
{
    public function save(Customer $user): void;
    public function update(int $id, float $value): void;
}
