<?php

namespace MoneyTransfer\Domain\Customers;

use MoneyTransfer\Domain\Cpf;
use MoneyTransfer\Library\HandlePassword;

class Common extends Customer implements CustomerInitializeInterface
{
    public const TYPE_CUSTOMER = 'COMMON';

    /**
     * @throws \Exception
     */
    public function initialize(
        ?int $id,
        string $name,
        string $email,
        float $value,
        ?string $document,
        ?string $password
    ): void
    {
        $this->setId($id);
        $this->setName($name);
        $this->setEmail($email);
        $this->setValue($value);
        $this->setPassword($password);
        $this->setDocument(new Cpf($document));
        $this->setType(self::TYPE_CUSTOMER);
    }

    public function allowsTransfer(): bool
    {
       return true;
    }
}
