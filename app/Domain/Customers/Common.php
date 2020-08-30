<?php

namespace MoneyTransfer\Domain\Customers;

use MoneyTransfer\Domain\Cpf;
use MoneyTransfer\Library\HandlePassword;

class Common extends Customer implements CustomerInitializeInterface
{
    const TYPE_CUSTOMER = 'COMMON';

    /*public function __construct(?int $id, string $name, string $email, float $value, ?Cpf $document, ?string $password)
    {
        parent::__construct(
            $id,
            $name,
            $email,
            $value,
            $password,
            $document->get(),
            self::TYPE_CUSTOMER
        );
    }*/

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
