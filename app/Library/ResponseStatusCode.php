<?php

namespace MoneyTransfer\Library;

class ResponseStatusCode
{
    private static int $statusCode = 200;

    public static function getStatusCode(): int
    {
        return self::$statusCode;
    }

    public static function setStatusCode(int $statusCode): void
    {
        self::$statusCode = $statusCode;
    }
}
