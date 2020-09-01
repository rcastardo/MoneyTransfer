<?php

namespace MoneyTransfer\Actions\Customer;

use MoneyTransfer\Actions\Base;
use MoneyTransfer\Library\Messages;
use MoneyTransfer\Library\ResponseStatusCode;

class ReadOne extends Base
{
    protected function handle(): array
    {
        try {
            $attribute = (int)$this->request->getAttribute('id');

            /** @var CustomerRepository $customers */
            $customers = $this->container->get('customer.repository');
            return $customers->findById($attribute);

        } catch (\Exception $e) {
            ResponseStatusCode::setStatusCode(404);
            Messages::add($e);
        }
    }
}
