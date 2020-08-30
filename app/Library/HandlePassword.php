<?php

namespace MoneyTransfer\Library;

class HandlePassword
{
    public static function generate(string $password)
    {
        return password_hash($password, PASSWORD_ARGON2ID);
    }

    public static function compare(string $password, string $hash)
    {
        return password_verify($password, $hash);
    }
}
