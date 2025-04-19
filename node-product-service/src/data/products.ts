import { v4 as uuidv4 } from 'uuid';
import { Product } from '../models/product';

const products: Product[] = [
    {
        id: '550e8400-e29b-41d4-a716-446655440000', // For testing purposes
        name: 'Laptop',
        price: 999.99
    },
    {
        id: uuidv4(),
        name: 'Smartphone',
        price: 699.99
    },
    {
        id: uuidv4(),
        name: 'Headphones',
        price: 199.99
    }
];

export default products; 