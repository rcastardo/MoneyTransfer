<?php
declare(strict_types=1);

namespace MoneyTransfer\Library;

use Exception;
use Throwable;

class Messages
{
    private static array $message = [];

    public static function add(Exception $exception)
    {
        self::$message[]['exception'] = [
            'message' => $exception->getMessage(),
            'code'    => $exception->getCode(),
            'file'    => $exception->getFile(),
            'line'    => $exception->getLine(),
        ];
    }

    public static function get()
    {
        return array_reverse(self::$message);
    }
}
