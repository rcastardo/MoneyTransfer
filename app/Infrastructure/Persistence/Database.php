<?php

namespace MoneyTransfer\Infrastructure\Persistence;

use PDO;

class Database
{
    public static function connect(array $config): PDO
    {
        $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};port={$config['port']};charset={$config['charset']}";

        $connection = new PDO($dsn, $config['user'], $config['password']);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $connection;
    }
}
