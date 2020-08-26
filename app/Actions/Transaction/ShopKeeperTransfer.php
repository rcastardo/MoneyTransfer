<?php

namespace MoneyTransfer\Actions\Transaction;

use MoneyTransfer\Actions\BaseAction;
use MoneyTransfer\Domain\Cnpj;
use MoneyTransfer\Domain\Users\ShopKeeper;

class ShopKeeperTransfer extends BaseAction
{
    protected function handle(): array
    {
        $customerSend = new ShopKeeper(
            'Lojas um',
            new Cnpj('11.123.456/1234-11'),
            '123456',
            'lojas1@loja.com',
            89000.45
        );

        return [
            'status' => $customerSend->allowsTransfer(),
        ];
    }
}
