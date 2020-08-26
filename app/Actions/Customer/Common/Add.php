<?php

namespace MoneyTransfer\Actions\Customer\Common;

use MoneyTransfer\Actions\BaseAction;
use MoneyTransfer\Domain\Cpf;
use MoneyTransfer\Domain\Users\Common;
use MoneyTransfer\Infrastructure\Repository\CustomerRepository;

class Add extends BaseAction
{
    protected function handle(): array
    {
        $customerCommon = new Common(
           'User tres',
           new Cpf('333.456.789-00'),
           '123456',
           'user3@gmail.com',
            56.00
        );

        (new CustomerRepository())->save($customerCommon);

        return [
            'status' => true,
        ];
    }
}
