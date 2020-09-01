<?php

use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../app/di.php';

$app = AppFactory::create();

.require __DIR__ . '/../app/error.php';
require __DIR__ . '/../app/routes.php';

$app->run();
