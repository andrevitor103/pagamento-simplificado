<?php

declare(strict_types=1);

namespace src\infra\controller\middleware;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Validation\ValidationException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use src\infra\controller\validation\UserCreateRequestValidation;
use src\infra\controller\validation\Validation;

final class MiddlewarePayloadValidator implements MiddlewareInterface
{
    public function __construct(
        private readonly Factory $factoryValidation
    ) {
    }

    /**
     * @throws ValidationException
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $class = $this->resolveClassFromRoute($request);
        $rules = $class->getRules();
        $validate = $this->factoryValidation->make($request->getParsedBody(), $rules);
        if ($validate->fails()) {
            throw new ValidationException($validate);
        }
        return $handler->handle($request);
    }

    private function resolveClassFromRoute(ServerRequestInterface $request): Validation
    {
        $routes = [
            "/user/create" => new UserCreateRequestValidation()
        ];
        return $routes[$request->getUri()->getPath()] ?? $this->buildDefaultValidation();
    }

    private function buildDefaultValidation(): Validation
    {
        return new class implements Validation {
            public function getRules(): array
            {
                return [];
            }
        };
    }
}
