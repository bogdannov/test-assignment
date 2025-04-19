<?php

namespace App\Tests\Unit\Services;

use App\Clients\ProductClient;
use App\DTO\ProductDTO;
use App\Errors\ProductNotFoundException;
use App\Errors\ProductServiceUnavailableException;
use App\Errors\RemoteServiceException;
use App\Repositories\InMemoryOrderRepository;
use App\Services\OrderService;
use PHPUnit\Framework\TestCase;
use Mockery;

class OrderServiceTest extends TestCase
{
    private ProductClient $productClient;
    private InMemoryOrderRepository $orderRepository;
    private OrderService $orderService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->productClient = Mockery::mock(ProductClient::class);
        $this->orderRepository = new InMemoryOrderRepository();
        $this->orderService = new OrderService($this->productClient, $this->orderRepository);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function testCreateOrderWithValidProduct(): void
    {
        $productId = '123';
        $quantity = 2;
        
        $this->productClient
            ->shouldReceive('getProduct')
            ->once()
            ->with($productId)
            ->andReturn(new ProductDTO(
                id: $productId,
                name: 'Test Product',
                price: 99.99
            ));

        $order = $this->orderService->createOrder($productId, $quantity);

        $this->assertNotNull($order->id);
        $this->assertEquals($productId, $order->productId);
        $this->assertEquals($quantity, $order->quantity);
        $this->assertEquals(199.98, $order->totalPrice);
    }

    public function testGetAllOrders(): void
    {
        $productId = '123';
        $quantity = 1;
        
        $this->productClient
            ->shouldReceive('getProduct')
            ->once()
            ->with($productId)
            ->andReturn(new ProductDTO(
                id: $productId,
                name: 'Test Product',
                price: 99.99
            ));

        $createdOrder = $this->orderService->createOrder($productId, $quantity);
        $allOrders = $this->orderService->getAllOrders();
        $retrievedOrder = $allOrders[0];

        $this->assertEquals($createdOrder->id, $retrievedOrder->id);
        $this->assertEquals($createdOrder->productId, $retrievedOrder->productId);
        $this->assertEquals($createdOrder->quantity, $retrievedOrder->quantity);
        $this->assertEquals($createdOrder->totalPrice, $retrievedOrder->totalPrice);
    }

    public function testCreateOrderFailsWhenProductNotFound(): void
    {
        $productId = 'missing';
        $quantity = 2;

        $this->productClient
            ->shouldReceive('getProduct')
            ->once()
            ->with($productId)
            ->andReturn(null);

        $this->expectException(ProductNotFoundException::class);

        $this->orderService->createOrder($productId, $quantity);
    }

    public function testCreateOrderFailsWhenProductServiceUnavailable(): void
    {
        $productId = '123';
        $quantity = 1;

        $this->productClient
            ->shouldReceive('getProduct')
            ->once()
            ->with($productId)
            ->andThrow(new RemoteServiceException('Service Down'));

        $this->expectException(ProductServiceUnavailableException::class);

        $this->orderService->createOrder($productId, $quantity);
    }
} 