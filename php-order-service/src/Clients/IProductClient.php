<?php

namespace App\Clients;

use App\dto\ProductDTO;
use App\Errors\RemoteServiceException;

interface IProductClient
{
    /**
     * @param string $productId
     * @return ProductDTO | null
     * @throws RemoteServiceException
     */
    public function getProduct(string $productId): ProductDTO | null;
}