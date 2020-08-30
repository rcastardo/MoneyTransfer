<?php

namespace MoneyTransfer\Domain;

class Cpf
{
    private string $cpf;

    public function __construct(string $cpf)
    {
        $this->set($cpf);
    }

    private function set(string $cpf): void
    {
        $options = [
            'options' => [
                'regexp' => '/\d{3}\.\d{3}\.\d{3}\-\d{2}/'
            ]
        ];
        if (filter_var($cpf, FILTER_VALIDATE_REGEXP, $options) === false) {
            throw new \InvalidArgumentException('CPF no formato inválido');
        }

        $this->cpf = $cpf;
    }

    public function __toString(): string
    {
        return $this->cpf;
    }
}
