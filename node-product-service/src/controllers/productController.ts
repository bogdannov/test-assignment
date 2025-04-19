import { NextFunction, Request, Response } from 'express';
import ProductService from '../services/productService';

class ProductController {
    private productService: ProductService;
    constructor(productService: ProductService) {
        this.productService = productService;
    }
    getAllProducts = async (req: Request, res: Response, next: NextFunction): Promise<void> => {
        try {
            const products = await this.productService.getAllProducts();
            res.json(products);
        } catch (error) {
            next(error);
        }
    }

    getProductById = async (req: Request, res: Response, next: NextFunction): Promise<void> => {
        try {
            const product = await this.productService.getProductById(req.params.id);
            res.json(product);
        } catch (error) {
            next(error);
        }
    }
}

export default ProductController;