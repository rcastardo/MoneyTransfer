<?php

namespace MoneyTransfer\Domain\Users;

use Exception;

abstract class Customer
{
    private string $name;
    private string $password;
    private string $email;
    private string $document;
    private string $type;
    private float $valueAccount;

    public function __construct(
        string $name,
        string $password,
        string $email,
        string $document,
        string $type,
        float $valueAccount
    ) {
        try {
            $this->validateName($name);
            $this->name = $name;
            $this->password = $password;
            $this->email = $email;
            $this->document = $document;
            $this->type = $type;
            $this->valueAccount = $valueAccount;
        } catch (Exception $e) {
        }
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getDocument(): string
    {
        return $this->document;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getValueAccount(): float
    {
        return $this->valueAccount;
    }

    /**
     * @throws Exception
     */
    final protected function validateName(string $name): bool
    {
        if (strlen($name) > 5 && strstr($name, ' ') !== false) {
            return true;
        }

        throw new Exception('Nome inválido');
    }

    abstract public function allowsTransfer(): bool;
}
