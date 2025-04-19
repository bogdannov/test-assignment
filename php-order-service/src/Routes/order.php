<?php

use App\Controllers\OrderController;
use Slim\App;

/**
 * @param App $app
 * @param OrderController $orderController
 * @return void
 */
return function (App $app, OrderController $orderController) {
    $app->post('/v1/orders', [$orderController, 'create']);
    $app->get('/v1/orders', [$orderController, 'list']);
};