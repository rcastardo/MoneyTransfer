<?php

namespace MoneyTransfer\Infrastructure\Repository;

use MoneyTransfer\Domain\Customers\Customer;

interface CustomerRepositoryInterface
{
    public function save(Customer $user): void;
    public function updateValueAccount(int $id, float $value): void;
    public function findById(int $id): array;
    public function findAll(): array;
    public function updateTransfer(Customer $payer, Customer $payee, float $transactionValue): void;
    public function delete(int $id): void;
}
