<?php

declare(strict_types=1);

namespace src\infra\controller\middleware;
use Slim\Psr7\Response;

final class HttpErrorResponse
{
    const CONTENT_TYPE = "application/json";
    public static function build(string $message = 'INTERNAL SERVER ERROR', int $statusCode = 500): Response
    {
        $response = new Response();
        $response->getBody()->write($message);
        $response->withHeader('Content-Type', self::CONTENT_TYPE);
        $response->withStatus($statusCode);
        return $response;
    }
}
