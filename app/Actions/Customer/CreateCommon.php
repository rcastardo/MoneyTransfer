<?php

namespace MoneyTransfer\Actions\Customer;

use Exception;
use MoneyTransfer\Actions\Base;
use MoneyTransfer\Domain\Customers\Common;
use MoneyTransfer\Infrastructure\Repository\CustomerRepository;
use MoneyTransfer\Library\{
    Messages,
    ResponseStatusCode
};

class CreateCommon extends Base
{
    protected function handle(): array
    {
        try {
            $params = $this->getBodyContent();

            $customer = new Common();
            $customer->initialize(
                null,
                $params['name'],
                $params['email'],
                $params['value'],
                $params['document'],
                $params['password']
            );

            (new CustomerRepository())->save($customer);

            return [
                'message' => 'Usuário cadastrado com sucesso',
            ];

        } catch (Exception $e) {
            ResponseStatusCode::setStatusCode(400);
            Messages::add($e);
        }
    }
}
