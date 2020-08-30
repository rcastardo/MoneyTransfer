<?php

namespace MoneyTransfer\Infrastructure\Persistence;

use MoneyTransfer\Config\Config;
use PDO;

class Connection
{
    public static function create(): PDO
    {
        $config = Config::get()['database'];
        $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};port={$config['port']};charset={$config['charset']}";

        $connection = new PDO($dsn, $config['user'], $config['password']);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $connection;
    }
}
