<?php

namespace MoneyTransfer\Library;

class UtilsResponse
{
    private static $statusCode = 200;

    /**
     * @return int
     */
    public static function getStatusCode(): int
    {
        return self::$statusCode;
    }

    /**
     * @param int $statusCode
     */
    public static function setStatusCode(int $statusCode)
    {
        self::$statusCode = $statusCode;
    }

}