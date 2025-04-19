import { IProductRepository } from '../repositories/iProductRepository';
import { Product } from '../models/product';
import { ProductNotFoundError } from '../errors/productNotFoundError';

class ProductService {
    private productRepository: IProductRepository;
    constructor(productRepository: IProductRepository) {
        this.productRepository = productRepository;
    }
    async getAllProducts(): Promise<Product[]> {
        return this.productRepository.getAll();
    }

    async getProductById(id: string): Promise<Product> {
        const product = await this.productRepository.getById(id);
        if (!product) {
            throw new ProductNotFoundError();
        }
        return product;
    }
}

export default ProductService;