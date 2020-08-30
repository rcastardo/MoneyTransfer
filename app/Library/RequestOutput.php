<?php

declare(strict_types=1);

namespace MoneyTransfer\Library;

class RequestOutput
{
    private static array $info = [];

    public static function addInfo(array $info): void
    {
        self::$info = array_merge(self::$info, $info);
    }

    public static function output($data = null, $status = false): array
    {
        return [
            'payload' => $data,
            'status' => $status,
            'error' => Messages::get(),
        ];
    }
}
