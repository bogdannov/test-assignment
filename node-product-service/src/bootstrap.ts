import InMemoryProductRepository from './repositories/inMemoryProductRepository';
import ProductService from './services/productService';
import ProductController from './controllers/productController';

// Manual Dependency Injection
const productRepository = new InMemoryProductRepository();
const productService = new ProductService(productRepository);
const productController = new ProductController(productService);

export { productController };