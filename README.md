# Order System (Node.js + PHP)

This project consists of two independent services working together:

- Node.js (TypeScript, express) — Product Service
- PHP (Slim) — Order Service

Together they simulate a basic product-ordering flow in a microservice-like setup.

## 📁 Project Structure


node-product-service/   # Node.js service for products

php-order-service/      # PHP Slim service for orders

## Setup & Installation

### Node.js — Product Service
```
cd node-product-service

npm install

cp .env.example .env
```

To start the service:
``` 
npm run dev
```

Runs on: http://localhost:3000

### PHP — Order Service

```
cd php-order-service

composer install

cp .env.example .env
```

To start the service:
```
php -S localhost:8000 -t public
```

Runs on: http://localhost:8000

## Manual API Testing

### Create Order
```
curl -X POST http://localhost:8000/v1/orders \
-H "Content-Type: application/json" \
-d '{"productId": "550e8400-e29b-41d4-a716-446655440000", "quantity": 2}'
```


Response: 201
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

### Get All Orders

```
curl http://localhost:8000/v1/orders
```


Response: list of created orders. 
In our case will not return any orders as we do not use a database by requirements.

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

## Notes
- Clean architecture applied
- Custom errors, validation, and request parsing
- Inter-service requests secured with an x-api-key header

## Missing (by intention)

This project focuses on architecture. The following production aspects are intentionally not included (because of requirements):

- Integration tests between services
- Authentication
- OpenAPI / Swagger documentation
- Monitoring
- Rate limiting
- Centralized/Logging error handler
- etc

