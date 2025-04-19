import { Request, Response, NextFunction } from "express";
import { UnauthorizedError } from '../errors/unauthorizedError';

// Just a simple middleware to check if the API key is present in the request headers
// To show the importance of using environment variables and authentication
export function checkApiKey(req: Request, res: Response, next: NextFunction) {
    const apiKey = req.headers["x-api-key"];
    if (apiKey !== process.env.API_KEY) {
        throw new UnauthorizedError();
    }
    next();
}