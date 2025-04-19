<?php

namespace App\Services;

use App\clients\IProductClient;
use App\DTO\OrderDTO;
use App\Errors\ProductServiceUnavailableException;
use App\Errors\RemoteServiceException;
use App\Errors\ProductNotFoundException;
use App\Repositories\IOrderRepository;
use Ramsey\Uuid\Uuid;

class OrderService
{
    private readonly IOrderRepository $orderRepository;
    private readonly IProductClient $productClient;

    public function __construct(
        IProductClient $productClient,
        IOrderRepository $orderRepository
    ) {
        $this->productClient = $productClient;
        $this->orderRepository = $orderRepository;
    }
    /**
     * @param string $productId
     * @param int $quantity
     * @return OrderDTO
     * @throws ProductNotFoundException
     * @throws ProductServiceUnavailableException
     */
    public function createOrder(string $productId, int $quantity): OrderDTO
    {
        try {
            $product = $this->productClient->getProduct($productId);
        } catch (RemoteServiceException $e) {
            throw new ProductServiceUnavailableException();
        }

        if (!$product) {
            throw new ProductNotFoundException();
        }

        $totalPrice = $product->price * $quantity;
        $order = new OrderDTO(
            id: Uuid::uuid4()->toString(),
            productId: $productId,
            quantity: $quantity,
            totalPrice: $totalPrice,
            createdAt: (new \DateTimeImmutable())->format(DATE_ATOM)
        );

        $this->orderRepository->save($order);
        return $order;
    }
    /**
     * @return OrderDTO[]
     */
    public function getAllOrders(): array
    {
        return $this->orderRepository->getAll();
    }
}