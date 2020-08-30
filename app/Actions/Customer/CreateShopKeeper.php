<?php

namespace MoneyTransfer\Actions\Customer;

use MoneyTransfer\Actions\Base;
use MoneyTransfer\Domain\Cnpj;
use MoneyTransfer\Domain\Customers\ShopKeeper;
use MoneyTransfer\Infrastructure\Repository\CustomerCrudRepository;
use MoneyTransfer\Library\{
    Messages,
    ResponseStatusCode
};

class CreateShopKeeper extends Base
{
    protected function handle(): array
    {
        //try {
            $params = $this->getBodyContent();;

            $customer = new ShopKeeper();
            $customer->initialize(
                null,
                $params['name'],
                $params['email'],
                $params['value'],
                $params['document'],
                $params['password']
            );

            (new CustomerCrudRepository())->save($customer);

            return [
                'message' => 'Lojista cadastrado com sucesso',
            ];

        //} catch (\Exception $e) {
        //    ResponseStatusCode::setStatusCode(400);
        //    Messages::add($e);
        //}
    }
}