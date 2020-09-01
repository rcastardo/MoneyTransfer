<?php

namespace Tests\Domain;

use InvalidArgumentException;
use MoneyTransfer\Domain\Cpf;
use PHPUnit\Framework\TestCase;

class CpfTest extends TestCase
{
    public function testCpf()
    {
        $this->expectException(InvalidArgumentException::class);

        new Cpf('123456789');
    }
}

