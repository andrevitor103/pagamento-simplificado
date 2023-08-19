<?php

declare(strict_types=1);

namespace src\infra\http\controller\middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Log\LoggerInterface;
final class MiddlewareLogRequestAndResponse implements MiddlewareInterface
{
    public function __construct(private readonly LoggerInterface $logger)
    {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $this->logger->info('http_request', ['data' => $request->getParsedBody()]);
        $result = $handler->handle($request);
        $this->logger->info('http_response', ['data' => $result->getStatusCode()]);
        return $handler->handle($request);
    }
}
