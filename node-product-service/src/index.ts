import dotenv from "dotenv";
import express, { Express } from 'express';
import productRoutes from './routes/products';
import { errorHandler } from './middleware/errorHandler';

dotenv.config();

const app: Express = express();
const PORT: number = parseInt(process.env.PORT || '3000', 10);

// Could be moved to a config file but for simplicity, I keep it here
const routePrefix = '/v1/products';

app.use(express.json());
app.use(routePrefix, productRoutes);

app.use(errorHandler);

app.listen(PORT, () => {
    console.log(`Product Service running on port ${PORT}`);
}); 