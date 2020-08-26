<?php

use Slim\Routing\RouteCollectorProxy;
use Middlewares\TrailingSlash;
use MoneyTransfer\Actions\IndexAction;
use MoneyTransfer\Actions\Customer\Common\Add as CommonAdd;
use MoneyTransfer\Actions\Customer\ShopKeeper\Add as ShopAdd;
use MoneyTransfer\Actions\Transaction\{
    ShopKeeperTransfer,
    CommonTransfer
};


$app->get('/', IndexAction::class);
$app->add(new TrailingSlash(false));

$app->group('/v1', function (RouteCollectorProxy $group) use ($app) {

    $group->group('/customer', function (RouteCollectorProxy $group) {
        $group->post('/common', CommonAdd::class)->setName('customer.add');
        $group->post('/shopkeeper', ShopAdd::class)->setName('shopkeeper.add');
    });

    $group->group('/transaction', function (RouteCollectorProxy $group) {
        $group->post('/shopkeeper', ShopKeeperTransfer::class)->setName('transaction.shopkeeper');
        $group->post('/common', CommonTransfer::class)->setName('transaction.shopkeeper');

    });

});
