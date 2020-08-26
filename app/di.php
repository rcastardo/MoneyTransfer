<?php

use Slim\Factory\AppFactory;
use DI\Container;

$container = new Container();

AppFactory::setContainer($container);
