<?php

namespace MoneyTransfer\Actions\Customer;

use MoneyTransfer\Actions\Base;
use MoneyTransfer\Library\Messages;
use MoneyTransfer\Library\ResponseStatusCode;

class ReadAll extends Base
{
    protected function handle(): array
    {
        try {

            /** @var CustomerRepository $customers */
            $customers = $this->container->get('customer.repository');
            return $customers->findAll();

        } catch (\Exception $e) {
            ResponseStatusCode::setStatusCode(400);
            Messages::add($e);
        }
    }
}
