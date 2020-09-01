<?php

namespace MoneyTransfer\Actions\Customer;

use Exception;
use MoneyTransfer\Actions\Base;
use MoneyTransfer\Domain\Customers\ShopKeeper;
use MoneyTransfer\Infrastructure\Repository\CustomerRepository;
use MoneyTransfer\Library\{
    Messages,
    ResponseStatusCode
};

class CreateShopKeeper extends Base
{
    protected function handle(): array
    {
        try {
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

            /** @var CustomerRepository $customers */
            $customers = $this->container->get('customer.repository');
            $customers->save($customer);

            return [
                'message' => 'Lojista cadastrado com sucesso',
            ];

        } catch (Exception $e) {
            ResponseStatusCode::setStatusCode(400);
            Messages::add($e);
        }
    }
}
