<?php

namespace App\Clients;

use App\dto\ProductDTO;
use App\Errors\RemoteServiceException;
use App\Errors\ValidationException;
use App\Utils\RequestUtils;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ProductClient implements IProductClient
{
    /**
     * Could be moved to a config file but for simplicity, I keep it here
     */
    private const ENDPOINT = '/v1/products';
    private Client $client;
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    /**
     * @param string $productId
     * @return ProductDTO|null
     * @throws RemoteServiceException|ValidationException
     */
    public function getProduct(string $productId): ProductDTO | null
    {
        try {
            $url = sprintf('%s/%s', self::ENDPOINT, $productId);
            $response = $this->client->request('GET', $url);

            $data = RequestUtils::parse($response->getBody()->getContents());

            if (!isset($data['id'], $data['name'], $data['price'])) {
                return null;
            }

            return new ProductDTO($data['id'], $data['name'], (float)$data['price']);
        } catch (GuzzleException $e) {
            if ($e->getCode() === 404) {
                return null;
            }

            throw new RemoteServiceException("Failed to connect to product service", 0, $e);
        }
    }
}