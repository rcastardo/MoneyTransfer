<?php

namespace MoneyTransfer\Domain\Transactions;

use Exception;
use MoneyTransfer\Domain\Customers\Retrieve;
use MoneyTransfer\Services\{
    AuthorizedTransaction,
    NotificationTransaction
};
use MoneyTransfer\Infrastructure\Repository\CustomerRepositoryInterface;

class TransactionFacade
{
    private CheckPayer $payer;
    private CheckPayee $payee;
    private CheckFunds $funds;
    private float $valueTransfer;
    private CustomerRepositoryInterface $customerRepository;

    /**
     * @throws Exception
     */
    public function __construct(CustomerRepositoryInterface $customerRepository, array $transactParams)
    {
        $retrieve = new Retrieve($customerRepository);
        $this->payer = new CheckPayer($retrieve, (int)$transactParams['payer']);
        $this->payee = new CheckPayee($retrieve, (int)$transactParams['payee']);
        $this->funds = new CheckFunds(
            (float)$this->payer->getUserValueAccount(),
            (float)$transactParams['value']
        );

        $this->valueTransfer = (float)$transactParams['value'];
        $this->customerRepository = $customerRepository;
    }

    /**
     * @throws Exception
     */
    public function run()
    {
        $this->validate();

        $this->customerRepository->updateTransfer(
            $this->payer->get(),
            $this->payee->get(),
            $this->valueTransfer
        );

        NotificationTransaction::send();
    }

    /**
     * @throws Exception
     */
    private function validate(): void
    {
        if (!$this->payer->canTransfer()) {
            throw new Exception('Usuário não permitido para realizar transferência.');
        }

        $this->funds->haveEnoughMoney();

        if (!AuthorizedTransaction::call()) {
            throw new Exception('Transferência não permitida no momento.');
        }
    }
}
