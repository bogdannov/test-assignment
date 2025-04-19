<?php

namespace App\Http;

use Psr\Http\Message\ResponseInterface;

class JsonResponse
{
    /**
     * @param ResponseInterface $response
     * @param array $data
     * @param int $status
     * @return ResponseInterface
     */
    public static function with(ResponseInterface $response, array $data, int $status = 200): ResponseInterface
    {
        $payload = json_encode($data);
        $response->getBody()->write($payload);
        return $response
            ->withStatus($status)
            ->withHeader('Content-Type', 'application/json');
    }
    /**
     * @param ResponseInterface $response
     * @param string $message
     * @param int $status
     * @return ResponseInterface
     */
    public static function error(ResponseInterface $response, string $message, int $status): ResponseInterface
    {
        return self::with($response, ['error' => $message], $status);
    }
}