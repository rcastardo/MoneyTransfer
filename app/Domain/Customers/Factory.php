<?php

namespace MoneyTransfer\Domain\Customers;

use Exception;

class Factory
{
    public static function build(string $type)
    {
        switch ($type) {
            case Common::TYPE_CUSTOMER:
                return new Common();
                break;
            case ShopKeeper::TYPE_CUSTOMER:
                return new ShopKeeper();
                break;
            default:
                throw new \Exception('Tipo de usuário inválido');
        }
    }
}
