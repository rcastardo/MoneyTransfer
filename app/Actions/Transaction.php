<?php


namespace MoneyTransfer\Actions;

use MoneyTransfer\Domain\Customers\Retrieve;
use MoneyTransfer\Domain\Transactions\CheckCustomer;
use MoneyTransfer\Domain\Transactions\CheckPayee;
use MoneyTransfer\Domain\Transactions\CheckPayer;
use MoneyTransfer\Domain\Transactions\TransactionFacade;
use MoneyTransfer\Library\Messages;
use MoneyTransfer\Library\ResponseStatusCode;

class Transaction extends Base
{
    protected function handle(): array
    {
        try {
            $params = $this->getBodyContent();

            $repository = $this->container->get('customer.repository');

            $retrieve = new Retrieve($repository);
            $payer = new CheckCustomer($retrieve, (int)$params['payer']);
            $payee = new CheckCustomer($retrieve, (int)$params['payee']);

            $transaction = new TransactionFacade();
            $transaction->setPayer($payer->get());
            $transaction->setPayee($payee->get());
            $transaction->trans.fer($repository, (float)$params['value']);

            return [
                'message' => 'Transferência realizada com sucesso',
            ];
        } catch (\Exception $e) {
            ResponseStatusCode::setStatusCode(400);
            Messages::add($e);
        }
    }
}
