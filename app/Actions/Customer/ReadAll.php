<?php

namespace MoneyTransfer\Actions\Customer;

use MoneyTransfer\Actions\Base;
use MoneyTransfer\Infrastructure\Repository\CustomerCrudRepository;
use MoneyTransfer\Library\Messages;
use MoneyTransfer\Library\ResponseStatusCode;

class ReadAll extends Base
{
    protected function handle(): array
    {
        try {

            return (new CustomerCrudRepository())->findAll();

        } catch (\Exception $e) {
            ResponseStatusCode::setStatusCode(400);
            Messages::add($e);
        }
    }
}
