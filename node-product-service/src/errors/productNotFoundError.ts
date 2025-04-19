import { CustomError } from './customError';

export class ProductNotFoundError extends CustomError {
    status = 404;
    constructor() {
        super('Error: Product not found');
        Object.setPrototypeOf(this, ProductNotFoundError.prototype);
    }
    serializeErrors() {
        return [{message: "Error: connecting to database"}];
    }
}