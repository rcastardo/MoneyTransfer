<?php

namespace MoneyTransfer\Domain\Customers;

use MoneyTransfer\Domain\Cnpj;

class ShopKeeper extends Customer
{
    public const TYPE_CUSTOMER = 'SHOPKEEPER';

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
        $this->setDocument(new Cnpj($document));
        $this->setType(self::TYPE_CUSTOMER);
    }

    public function allowsTransfer(): bool
    {
        return false;
    }
}
