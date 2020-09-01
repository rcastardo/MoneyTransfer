<?php

namespace Tests\Transactions;

use MoneyTransfer\Domain\Customers\Common;
use MoneyTransfer\Domain\Customers\Retrieve;
use MoneyTransfer\Domain\Transactions\CheckCustomer;
use MoneyTransfer\Domain\Transactions\TransactionFacade;
use MoneyTransfer\Infrastructure\Repository\CustomerRepository;
use PHPUnit\Framework\TestCase;

class TransactionFacadeTest extends TestCase
{
    private $params;
    private $customerRepository;
    private $retrieve;
    private $payer;
    private $payee;
    private $transaction;

    public function setUp(): void
    {
        parent::setUp();

        $this->customerRepository = $this->createMock(CustomerRepository::class);
        $this->retrieve = $this->createMock(Retrieve::class);
        $this->payer = $this->createMock(CheckCustomer::class);
        $this->payee = $this->createMock(CheckCustomer::class);

        $this->transaction = new TransactionFacade();
        $this->transaction->setPayer($this->getPayer());
        $this->transaction->setPayee($this->getPayee());
    }

    public function testTransfer()
    {
        $this->transaction->transfer(
            $this->customerRepository,
            20.00
        );
    }

    public function getPayer()
    {
        $customer = new Common();
        $customer->initialize(
            1,
            'teste um',
            'teste1@teste.com',
            500.00,
            '000.000.000-01',
            null
        );

        return $customer;
    }

    public function getPayee()
    {
        $customer = new Common();
        $customer->initialize(
            2,
            'teste dois',
            'teste2@teste.com',
            38.00,
            '000.000.000-02',
            null
        );

        return $customer;
    }
}
