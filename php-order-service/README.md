# Order Service

A PHP-based microservice for managing orders, built with Slim Framework 4. The service integrates with the Product Service to validate products before creating orders.

## Architecture

The service follows a layered architecture:
- **Controllers**: Handle HTTP requests and responses
- **Services**: Implement business logic
- **Repositories**: Manage data persistence
- **DTOs**: Data Transfer Objects for type-safe data handling
- **Clients**: External service integrations
- **Validators**: Input validation
- **Errors**: Custom exception handling

## Prerequisites

- PHP 8.1 or higher
- Composer
- Access to the Product Service

## Setup

1. Install dependencies:
```bash
composer install
```

2. Create a `.env` file in the root directory:
```bash
cp .env.example .env
```

## Building and Running

1. Start the server:
```bash
php -S localhost:8000 -t public
```

The service will run on http://localhost:8000

## API Endpoints

### POST /v1/orders
Creates a new order.

Request:
```bash
curl -X POST http://localhost:8000/v1/orders \
-H "Content-Type: application/json" \
-H "x-api-key: my-secret-key" \
-d '{
    "productId": "550e8400-e29b-41d4-a716-446655440000",
    "quantity": 2
}'
```

Response:
```json
{
    "id": "550e8400-e29b-41d4-a716-446655440000",
    "productId": "550e8400-e29b-41d4-a716-446655440000",
    "quantity": 2,
    "totalPrice": 1999.98,
    "createdAt": "2024-04-18T12:00:00Z"
}
```

### GET /v1/orders
Returns a list of all orders.

Note: Orders are stored in memory. A successful response might look like:
Request:
```bash
curl http://localhost:8000/v1/orders \
-H "x-api-key: my-secret-key"
```

Response:
```json
[
    {
        "id": "550e8400-e29b-41d4-a716-446655440000",
        "productId": "550e8400-e29b-41d4-a716-446655440000",
        "quantity": 2,
        "totalPrice": 1999.98,
        "createdAt": "2024-04-18T12:00:00Z"
    }
]
```

## Testing

Run the test suite:
```bash
composer test
```

## Error Handling

The service returns appropriate HTTP status codes and error messages:

- 400 Bad Request: Invalid input data
- 404 Not Found: Resource not found
- 500 Internal Server Error: Server-side error
- 503 Service Unavailable: Product service unavailable

Example error response:
```json
{
    "error": {
        "message": "Product not found",
        "code": "PRODUCT_NOT_FOUND",
        "status": 404
    }
}
``` 