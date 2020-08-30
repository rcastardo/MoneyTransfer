<?php

namespace MoneyTransfer\Config;

class Config
{
    public static function get()
    {
        return [
            'jwt' => [
                'key' => 'fe0c74be07578ab7a3c87d7af54c42b9',
                'hash' => 'HS256',
                'authTTL' => 86400,       // 1 dia
                'refreshTTL' => 604800,   // 1 semana
                'tenYears' => 290304000,  // 10 anos
                'iss' => 'moneytransfer.rc',  // Emissor
            ],
            'database' => [
                'user' => 'root',
                'password' => 'sqladmin',
                'host' => 'moneytransfer-mysql',
                'dbname' => 'moneytransfer',
                'port' => '3306',
                'charset' => 'utf8',
            ]
        ];
    }
}
