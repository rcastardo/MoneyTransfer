<?php

namespace MoneyTransfer\Actions;

class IndexAction extends BaseAction
{
    protected function handle(): array
    {
        return [
            'status' => true,
        ];
    }
}
