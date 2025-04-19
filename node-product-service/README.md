# Product Service

A TypeScript-based Node.js service for managing products, built with Express.js. The service provides a REST API for product management.

## Architecture

The service follows a layered architecture:
- **Controllers**: Handle HTTP requests and responses
- **Services**: Implement business logic
- **Repositories**: Manage data persistence
- **Models**: Define data structures
- **Errors**: Custom exception handling
- **Middleware**: Request processing and validation

## Prerequisites

- Node.js 16 or higher
- npm or yarn
- TypeScript 5.0 or higher

## Setup

1. Install dependencies:
```bash
npm install
```

2. Create a `.env` file in the root directory:
```bash
cp .env.example .env
```

3. Configure environment variables in `.env` if needed:
```
PORT=3000
API_KEY=your-secret-api-key
```

## Development

For development with hot-reload:
```bash
npm run dev
```

## Building and Running

1. Build the TypeScript code:
```bash
npm run build
```

2. Start the server:
```bash
npm start
```

The service will run on http://localhost:3000

## API Endpoints

All endpoints require an `x-api-key` header for authentication.

### GET /v1/products
Returns a list of all available products.

Request:
```bash
curl http://localhost:3000/v1/products \
-H "x-api-key: my-secret-key"
```

Response:
```json
[
    {
        "id": "550e8400-e29b-41d4-a716-446655440000",
        "name": "Laptop",
        "price": 999.99
    },
    {
        "id": "550e8400-e29b-41d4-a716-446655440001",
        "name": "Smartphone",
        "price": 699.99
    }
]
```

### GET /v1/products/:id
Returns a single product by ID.

Request:
```bash
curl http://localhost:3000/v1/products/550e8400-e29b-41d4-a716-446655440000 \
-H "x-api-key: your-secret-api-key"
```

### GET /v1/orders
Returns a list of all orders.

Note: Orders are stored in memory according to the terms of the task so the answer will be empty. 

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


## Error Handling

The service returns appropriate HTTP status codes and error messages:

- 400 Bad Request: Invalid input data
- 401 Unauthorized: Missing or invalid API key
- 404 Not Found: Product not found
- 500 Internal Server Error: Server-side error

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

## Testing

Run the test suite:
```bash
npm test
```