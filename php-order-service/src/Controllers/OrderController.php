<?php

namespace App\Controllers;

use App\Http\JsonResponse;
use App\Serializers\OrderSerializer;
use App\Services\OrderService;
use App\Utils\RequestUtils;
use App\Validators\ValidatorFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class OrderController
{
    private readonly OrderService $orderService;

    public function __construct(
        OrderService $orderService,
    ) {
        $this->orderService = $orderService;
    }
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function create(Request $request, Response $response): Response
    {
        try {
            $validator = ValidatorFactory::create('order.create');
            $data = RequestUtils::parse($request->getBody()->getContents());
            $validator->validate($data);

            $order = $this->orderService->createOrder($data['productId'], (int) $data['quantity']);

            return JsonResponse::with($response, OrderSerializer::toArray($order), 201);
        } catch (\Exception $e) {
            return JsonResponse::error($response, $e->getMessage(), $e->getCode());
        }
    }
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function list(Request $request, Response $response): Response
    {
        $orders = $this->orderService->getAllOrders();
        return JsonResponse::with($response, OrderSerializer::listToArray($orders));
    }
}