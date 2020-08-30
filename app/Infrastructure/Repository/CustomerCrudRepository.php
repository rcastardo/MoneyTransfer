<?php

namespace MoneyTransfer\Infrastructure\Repository;

use PDO;
use PDOException;
use Exception;
use MoneyTransfer\Infrastructure\Persistence\Connection;
use MoneyTransfer\Domain\Customers\Customer;
use MoneyTransfer\Domain\Customers\CustomerCrudInterface;

class CustomerCrudRepository implements CustomerCrudInterface
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = Connection::create();
    }

    public function save(Customer $customer): void
    {
        try {
            $query = '
                INSERT INTO customers (name, document, email, password, type, value)
                VALUES (:name, :document, :email, :password, :type, :value)
            ';

            $statement = $this->connection->prepare($query);
            $statement->execute([
                'name' => $customer->getName(),
                'document' => $customer->getDocument(),
                'email' => $customer->getEmail(),
                'password' => $customer->getPassword(),
                'type' => $customer->getType(),
                'value' => $customer->getValue()
            ]);

        } catch (PDOException $e) {
           throw $e;
        }
    }

    public function updateValueAccount(int $id, float $value): void
    {
        $query = '
            UPDATE customers SET value = :value WHERE id = :id
        ';

        $stmt = $this->connection->prepare($query);
        $stmt->bindValue('value', $value);
        $stmt->bindValue('id', $id, PDO::PARAM_INT);

        $stmt->execute();
    }

    public function updateTransfer(Customer $payer, Customer $payee, float $transactionValue)
    {
        $this->connection->beginTransaction();

        try {

            $this->updateValueAccount($payer->getId(), (float)($payer->getValue() - $transactionValue));
            $this->updateValueAccount($payee->getId(), (float)($payee->getValue() + $transactionValue));

            $this->connection->commit();
        } catch (PDOException $e) {
            $this->connection->rollBack();
            throw $e;
        }
    }

    public function findAll(): array
    {
        $query = 'SELECT id, name, email, document, type, value FROM customers';
        return $this->connection->query($query)->fetchAll();
    }

    /**
     * @throws Exception
     */
    public function findById(int $id): array
    {
        $query = 'SELECT id, name, email, document, type, value FROM customers WHERE id = :id';
        $statement = $this->connection->prepare($query);
        $statement->bindValue('id', $id);
        $statement->execute();

        $customer = $statement->fetch();

        if (!$customer) {
            throw new Exception('Usuário não encontrado', 404);
        }

        return $customer;
    }

    public function delete(int $id): void
    {
        $query = 'DELETE FROM customers WHERE id = :id';
        $statement = $this->connection->prepare($query);
        $statement->bindValue('id', $id);
        $statement->execute();
    }
}
