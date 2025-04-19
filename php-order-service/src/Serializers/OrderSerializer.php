<?php

namespace App\Serializers;

use App\DTO\OrderDTO;

class OrderSerializer
{
    /**
     * @param OrderDTO $order
     * @return array
     */
    public static function toArray(OrderDTO $order): array
    {
        return [
            'orderId' => $order->id,
            'productId' => $order->productId,
            'quantity' => $order->quantity,
            'totalPrice' => $order->totalPrice,
            'createdAt' => $order->createdAt,
        ];
    }
    /**
     * @param array $orders
     * @return array
     */
    public static function listToArray(array $orders): array
    {
        return array_map([self::class, 'toArray'], $orders);
    }
}