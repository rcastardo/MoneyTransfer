<?php

namespace MoneyTransfer\Infrastructure\Repository;

use PDO;
use PDOException;
use MoneyTransfer\Infrastructure\Persistence\Connection;
use MoneyTransfer\Domain\Users\Customer;
use MoneyTransfer\Domain\Users\CustomerInterface;

class CustomerRepository implements CustomerInterface
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = Connection::create();
    }

    public function save(Customer $customer): void
    {
        $query = '
            INSERT INTO customers (name, document, email, password, type, value_account) 
            VALUES (:name, :document, :email, :password, :type, :value_account)
        ';

        $stmt = $this->connection->prepare($query);
        $stmt->bindValue('name', $customer->getName());
        $stmt->bindValue('document', $customer->getDocument());
        $stmt->bindValue('email', $customer->getEmail());
        $stmt->bindValue('password', $customer->getPassword());
        $stmt->bindValue('type', $customer->getType());
        $stmt->bindValue('value_account', $customer->getValueAccount());

        $stmt->execute();
    }

    public function update(int $id, float $value): void
    {

        $query = '
            UPDATE customers SET value_account = :value_account WHERE id = :id
        ';

        $stmt = $this->connection->prepare($query);
        $stmt->bindValue('value_account', $value);
        $stmt->bindValue('id', $id, PDO::PARAM_INT);

        $stmt->execute();
    }

    public function updateTransfer(int $payer, int $payee, float $valuePayer, float $valuePayee)
    {
        $this->connection->beginTransaction();

        try {

            $this->update($payer, $valuePayer);
            $this->update($payee, $valuePayee);

            $this->connection->commit();
        } catch (PDOException $e) {
            echo $e->getMessage();
            $this->connection->rollBack();
        }
    }
}
