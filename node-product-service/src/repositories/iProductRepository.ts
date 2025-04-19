import { Product } from "../models/product";
export interface IProductRepository {
    getAll(): Promise<Product[]>;
    getById(id: string): Promise<Product | null>;
}