import { Request, Response, NextFunction } from "express";

interface AppError extends Error {
    status?: number;
    code?: string;
}

export function errorHandler(
    err: AppError,
    req: Request,
    res: Response,
    _next: NextFunction
) {
    const status = err.status || 500;
    const message = err.message || "Internal Server Error";
    const code = err.code || "INTERNAL_SERVER_ERROR";

    // Log error with more context
    console.error({
        timestamp: new Date().toISOString(),
        path: req.path,
        method: req.method,
        status,
        message,
        code,
        stack: process.env.NODE_ENV === 'development' ? err.stack : undefined
    });

    return res.status(status).json({
        error: {
            message,
            code,
            status
        }
    });
}