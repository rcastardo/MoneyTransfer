<?php

namespace MoneyTransfer\Actions\Customer\ShopKeeper;

use MoneyTransfer\Actions\BaseAction;
use MoneyTransfer\Domain\Cnpj;
use MoneyTransfer\Domain\Users\ShopKeeper;
use MoneyTransfer\Infrastructure\Repository\CustomerRepository;

class Add extends BaseAction
{
    protected function handle(): array
    {
        $customerShop = new ShopKeeper(
           'Lojas um',
           new Cnpj('11.123.456/1234-11'),
           '123456',
           'lojas1@loja.com',
            89000.45
        );

        (new CustomerRepository())->save($customerShop);

        return [
            'status' => true,
        ];
    }
}
