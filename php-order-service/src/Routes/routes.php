<?php

use Slim\App;

return function (App $app) {
    $container = require __DIR__ . '/../bootstrap.php';

    $orderController = $container['orderController'];

    (require __DIR__ . '/order.php')($app, $orderController);
};
