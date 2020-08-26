<?php

declare(strict_types=1);

namespace MoneyTransfer\Library;

class RequestOutput
{
    public static function output($data = null, $status = false)
    {
        return [
            "payload"      => $data,
            "status"       => $status,
        ];
    }
}
