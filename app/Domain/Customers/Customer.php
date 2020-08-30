<?php

namespace MoneyTransfer\Domain\Customers;

use Exception;
use InvalidArgumentException;
use MoneyTransfer\Library\HandlePassword;

abstract class Customer
{
    private ?int $id;
    private string $name;
    private ?string $password;
    private string $email;
    private ?string $document;
    private string $type;
    private float $value;

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @throws Exception
     */
    public function setName(string $name): void
    {
        $this->validateName($name);
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setPassword(?string $password): void
    {
        if (is_null($password)) {
            return;
        }

        $this->password = HandlePassword::generate($password);
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setDocument(string $document): void
    {
        $this->document = $document;
    }

    public function getDocument(): string
    {
        return $this->document;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setValue(float $value): void
    {
        $this->value = $value;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @throws Exception
     */
    final protected function validateName(string $name): bool
    {
        if (strlen($name) > 5 && strstr($name, ' ') !== false) {
            return true;
        }

        throw new InvalidArgumentException('Nome inválido');
    }

    abstract public function allowsTransfer(): bool;
}
