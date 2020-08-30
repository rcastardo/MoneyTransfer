<?php

namespace MoneyTransfer\Actions\Customer;

use MoneyTransfer\Actions\Base;
use MoneyTransfer\Infrastructure\Repository\CustomerCrudRepository;
use MoneyTransfer\Library\Messages;
use MoneyTransfer\Library\ResponseStatusCode;

class ReadOne extends Base
{
    protected function handle(): array
    {
        try {
            $attribute = (int)$this->request->getAttribute('id');

            return (new CustomerCrudRepository())->findById($attribute);

        } catch (\Exception $e) {
            ResponseStatusCode::setStatusCode(404);
            Messages::add($e);
        }
    }
}
