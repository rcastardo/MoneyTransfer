<?php

use Slim\Factory\AppFactory;
use DI\Container;

$container = new Container();

$container->set('config', function () {
    return Config::get();
});

AppFactory::setContainer($container);
