<?php

use App\Clients\ProductClient;
use App\Controllers\OrderController;
use App\Repositories\InMemoryOrderRepository;
use App\Services\OrderService;
use Dotenv\Dotenv;
use GuzzleHttp\Client;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$baseUrl = $_ENV['PRODUCT_SERVICE_URL'];
$apiKey = $_ENV['API_KEY'];

$client = new Client([
    'base_uri' => $baseUrl,
    'headers' => [
        'x-api-key' => $apiKey
    ]
]);
$productClient = new ProductClient($client);
$orderRepository = new InMemoryOrderRepository();
$orderService = new OrderService($productClient, $orderRepository);
$orderController = new OrderController($orderService);

return [
    'orderController' => $orderController,
];