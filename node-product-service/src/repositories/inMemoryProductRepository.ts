import products from '../data/products';
import { Product } from '../models/product';
import { IProductRepository } from './iProductRepository';

class InMemoryProductRepository implements IProductRepository{
    async getAll(): Promise<Product[]> {
        return products;
    }

    async getById(id: string): Promise<Product | null> {
        const product = products.find((p) => p.id === id);
        return product ?? null;
    }
}

export default InMemoryProductRepository;