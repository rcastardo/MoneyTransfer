<?php

namespace MoneyTransfer\Domain\Customers;

interface CustomerInitializeInterface
{
    public function initialize(
        ?int $id,
        string $name,
        string $email,
        float $value,
        ?string $document,
        ?string $password
    ): void;
}
