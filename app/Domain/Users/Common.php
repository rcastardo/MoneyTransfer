<?php

namespace MoneyTransfer\Domain\Users;

use MoneyTransfer\Domain\Cpf;

class Common extends Customer
{
    const TYPE_CUSTOMER = 'COMMON';

    public function __construct(string $name, Cpf $document, string $password, string $email, float $value)
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
       return true;
    }
}
