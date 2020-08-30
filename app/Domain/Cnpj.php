<?php

namespace MoneyTransfer\Domain;

class Cnpj
{
    private string $cnpj;

    public function __construct(string $cnpj)
    {
        $this->set($cnpj);
    }

    private function set(string $cnpj): void
    {
        $options = [
            'options' => [
                'regexp' => '/\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}/'
            ]
        ];
        if (filter_var($cnpj, FILTER_VALIDATE_REGEXP, $options) === false) {
            throw new \InvalidArgumentException('CNPJ no formato inválido');
        }

        $this->cnpj = $cnpj;
    }

    public function __toString(): string
    {
        return $this->cnpj;
    }
}
