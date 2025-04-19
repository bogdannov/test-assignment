import ProductService from '../services/productService';
import { Product } from '../models/product';
import { ProductNotFoundError } from '../errors/productNotFoundError';

describe('ProductService', () => {
  const mockProduct: Product = {
    id: '1',
    name: 'Test Product',
    price: 99.99
  };

  const mockRepository = {
    getAll: jest.fn(),
    getById: jest.fn(),
  };

  let productService: ProductService;

  beforeEach(() => {
    jest.clearAllMocks();
    productService = new ProductService(mockRepository);
  });

  describe('getAllProducts', () => {
    it('should return all products', async () => {
      const products = [mockProduct];
      mockRepository.getAll.mockResolvedValue(products);

      const result = await productService.getAllProducts();

      expect(result).toEqual(products);
      expect(mockRepository.getAll).toHaveBeenCalledTimes(1);
    });

    it('should return empty array when no products exist', async () => {
      mockRepository.getAll.mockResolvedValue([]);

      const result = await productService.getAllProducts();

      expect(result).toEqual([]);
      expect(mockRepository.getAll).toHaveBeenCalledTimes(1);
    });
  });

  describe('getProductById', () => {
    it('should return product when it exists', async () => {
      mockRepository.getById.mockResolvedValue(mockProduct);

      const result = await productService.getProductById('1');

      expect(result).toEqual(mockProduct);
      expect(mockRepository.getById).toHaveBeenCalledWith('1');
    });

    it('should throw ProductNotFoundError when product does not exist', async () => {
      mockRepository.getById.mockResolvedValue(null);

      await expect(productService.getProductById('1'))
        .rejects
        .toThrow(ProductNotFoundError);
      
      expect(mockRepository.getById).toHaveBeenCalledWith('1');
    });
  });
}); 