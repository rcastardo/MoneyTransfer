<?php

namespace MoneyTransfer\Domain\Transactions;

use Exception;
use MoneyTransfer\Services\{
    AuthorizedTransaction,
    NotificationTransaction
};
use MoneyTransfer\Domain\Customers\Customer;
use MoneyTransfer\Infrastructure\Repository\CustomerRepositoryInterface;

class TransactionFacade
{
    public const MINIMUM_VALUE = 1;

    private Customer $payer;
    private Customer $payee;
    private float $valueTransfer;

    public function setPayer(Customer $payer)
    {
        $this->payer = $payer;
    }

    public function setPayee(Customer $payee)
    {
        $this->payee = $payee;
    }

    /**
     * @param CustomerRepositoryInterface $customerRepository
     * @param float $valueTransfer
     * @throws Exception
     */
    public function transfer(CustomerRepositoryInterface $customerRepository, float $valueTransfer)
    {
        $this->valueTransfer = $valueTransfer;
        $this->validate();

        $customerRepository->updateTransfer(
            $this->payer,
            $this->payee,
            $valueTransfer
        );

        NotificationTransaction::send();
    }

    /**
     * @throws Exception
     */
    private function validate(): void
    {
        if ($this->valueTransfer < self::MINIMUM_VALUE) {
            throw new Exception('Valor não permitido para realizar transferência.');
        }

        if (!$this->payer->allowsTransfer()) {
            throw new Exception('Usuário não permitido para realizar transferência.');
        }

        if (CheckFunds::haveEnoughMoney((float)$this->payer->getValue(), $this->valueTransfer)) {
            throw new Exception('Não há dinheiro suficiente na conta.');
        }

        if (!AuthorizedTransaction::call()) {
            throw new Exception('Transferência não permitida no momento.');
        }
    }
}
