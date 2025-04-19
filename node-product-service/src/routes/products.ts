import { Router } from 'express';
import { checkApiKey } from '../middleware/checkApiKey';
import { productController } from '../bootstrap';

const router = Router();

// Simple middleware to check for API key
router.use(checkApiKey);

router.get('/', productController.getAllProducts);
router.get('/:id', productController.getProductById);

export default router; 