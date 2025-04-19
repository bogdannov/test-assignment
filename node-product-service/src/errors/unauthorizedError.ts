import { CustomError } from './customError';

export class UnauthorizedError extends CustomError {
    status = 401;
    constructor() {
        super('Unauthorized access');
        Object.setPrototypeOf(this, UnauthorizedError.prototype);
    }
    serializeErrors() {
        return [{message: "Error: Unauthorized access"}];
    }
}