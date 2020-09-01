<?php

use Slim\Factory\AppFactory;
use DI\Container;
use MoneyTransfer\Config\Config;
use MoneyTransfer\Infrastructure\Persistence\Database;
use MoneyTransfer\Infrastructure\Repository\CustomerRepository;

$container = new Container();

$container->set('config', function () {
    return Config::get();
});

$container->set('connection', function (Container $container)  {

    $config = $container->get('config')['database'];
    return Database::connect($config);

});

$container->set('customer.repository', function(Container $container) {
    return new CustomerRepository($container);
});


AppFactory::setContainer($container);
