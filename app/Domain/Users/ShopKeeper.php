<?php

namespace MoneyTransfer\Domain\Users;

use MoneyTransfer\Domain\Cnpj;

class ShopKeeper extends Customer
{
    public const TYPE_CUSTOMER = 'SHOPKEEPER';

    public function __construct(string $name, Cnpj $document, string $password, string $email, float $value)
    {
        parent::__construct(
            $name,
            $password,
            $email,
            $document->get(),
            self::TYPE_CUSTOMER,
            $value
        );
    }

    public function allowsTransfer(): bool
    {
        return false;
    }
}