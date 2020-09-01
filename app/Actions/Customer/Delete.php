<?php

namespace MoneyTransfer\Actions\Customer;

use MoneyTransfer\Actions\Base;
use MoneyTransfer\Library\Messages;
use MoneyTransfer\Library\ResponseStatusCode;

class Delete extends Base
{
    protected function handle(): array
    {
        try {
            $attribute = (int)$this->request->getAttribute('id');

            /** @var CustomerRepository $customers */
            $customers = $this->container->get('customer.repository');
            $customers->delete($attribute);

            return [
                'message' => 'Usuário excluído com sucesso',
            ];

        } catch (\Exception $e) {
            ResponseStatusCode::setStatusCode(400);
            Messages::add($e);
        }
    }
}
