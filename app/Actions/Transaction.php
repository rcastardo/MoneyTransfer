<?php


namespace MoneyTransfer\Actions;


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

            (new TransactionFacade($params))->run();

            return [
                'message' => 'Transferência realizada com sucesso',
            ];
        } catch (\Exception $e) {
            ResponseStatusCode::setStatusCode(400);
            Messages::add($e);
        }
    }
}
