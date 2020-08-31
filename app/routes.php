<?php

use Slim\Routing\RouteCollectorProxy;
use Middlewares\TrailingSlash;
use MoneyTransfer\Actions\Index;
use MoneyTransfer\Actions\Transaction;
use MoneyTransfer\Actions\Customer\{
    CreateCommon,
    CreateShopKeeper,
    ReadAll,
    ReadOne,
    Delete
};

$app->get('/', Index::class);
$app->add(new TrailingSlash(false));

$app->group('/v1', function (RouteCollectorProxy $group) use ($app) {

    $group->group('/customer', function (RouteCollectorProxy $group) {
        $group->get('', ReadAll::class)->setName('customer.list.all');
        $group->get('/{id:[0-9]+}', ReadOne::class)->setName('customer.list.one');
        $group->delete('/{id:[0-9]+}', Delete::class)->setName('customer.delete');
        $group->post('/common', CreateCommon::class)->setName('customer.common.create');
        $group->post('/shopkeeper', CreateShopKeeper::class)
            ->setName('customer.shopkeeper.create');
    });

    $group->post('/transaction',Transaction::class)->setName('transaction');

});
