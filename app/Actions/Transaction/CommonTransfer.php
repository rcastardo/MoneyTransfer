<?php

namespace MoneyTransfer\Actions\Transaction;

use MoneyTransfer\Actions\BaseAction;
use MoneyTransfer\Domain\Cnpj;
use MoneyTransfer\Domain\Cpf;
use MoneyTransfer\Domain\Users\{
    Common,
    Customer,
    CustomerValidateInterface,
    ShopKeeper
};
use MoneyTransfer\Infrastructure\Repository\CustomerRepository;
use MoneyTransfer\Services\Authorized;
use MoneyTransfer\Services\Notification;

class CommonTransfer extends BaseAction implements CustomerValidateInterface
{
    public const MINIMUM_VALUE = 1;

    private float $valueTransfer = 50.00;

    protected function handle(): array
    {
        $customerCommon = new Common(
            'Reginaldo Castardo',
            new Cpf('123.456.789-00'),
            '123456',
            'rcastardo@gmail.com',
            1000.00
        );

        if (!$this->validate($customerCommon)) {
            return [
                'status' => false,
            ];
        }

        $customerShopKeeper = new ShopKeeper(
            'Lojas Silva',
            new Cnpj('11.123.456/1234-11'),
            '123456',
            'lojas@silva.com',
            5500.00
        );

        $repository = new CustomerRepository();
        $repository->updateTransfer(
            2,
            1,
            ($customerCommon->getValueAccount() - $this->valueTransfer),
            ($customerShopKeeper->getValueAccount() + $this->valueTransfer)
        );

        Notification::send();

        return [
            'status' => true,
        ];
    }

    public function validate(Customer $customer): bool
    {
        if (!$customer->allowsTransfer()) {
            return false;
        }

        if ($customer->getValueAccount() < self::MINIMUM_VALUE) {
            return false;
        }

        if ($this->valueTransfer > $customer->getValueAccount()) {
            return false;
        }

        return Authorized::call();
    }
}
