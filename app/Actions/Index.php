<?php

namespace MoneyTransfer\Actions;

class Index extends Base
{
    protected function handle(): array
    {
        return [
            'status' => true,
        ];
    }
}
