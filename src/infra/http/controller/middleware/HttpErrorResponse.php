<?php

declare(strict_types=1);

namespace src\infra\http\controller\middleware;
use Slim\Psr7\Response;

final class HttpErrorResponse
{
    const CONTENT_TYPE = "application/json";
    public static function build(string $message = 'INTERNAL SERVER ERROR', int $statusCode = 500): Response
    {
        $response = new Response();
        $response->getBody()->write($message);
        return $response
                ->withHeader('Content-type', self::CONTENT_TYPE)
                ->withStatus($statusCode);
    }
}
